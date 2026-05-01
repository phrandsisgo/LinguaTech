<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ApiUsageLog;
use App\Models\LangOption;
use App\Models\Text;
use App\Models\Word;
use App\Models\WordList;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OpenAI;

class TextController extends Controller
{
    public function index(): JsonResponse
    {
        $texts = Text::with('langOption')
            ->where('created_by', auth()->id())
            ->orderBy('updated_at', 'desc')
            ->get();

        return response()->json($texts);
    }

    public function show(int $id): JsonResponse
    {
        $text = Text::with('langOption')->findOrFail($id);

        return response()->json($text);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'lang_option_id' => 'required|integer|exists:lang_options,id',
        ]);

        $text = new Text();
        $text->title = $request->title;
        $text->text = $request->text;
        $text->lang_option_id = $request->lang_option_id;
        $text->created_by = auth()->id();
        $text->save();

        return response()->json(Text::with('langOption')->find($text->id), 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'lang_option_id' => 'required|integer|exists:lang_options,id',
        ]);

        $text = Text::findOrFail($id);

        if ($text->created_by !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $text->title = $request->title;
        $text->text = $request->text;
        $text->lang_option_id = $request->lang_option_id;
        $text->updated_at = now();
        $text->save();

        return response()->json(Text::with('langOption')->find($text->id));
    }

    public function destroy(int $id): JsonResponse
    {
        $text = Text::findOrFail($id);

        if ($text->created_by !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $text->delete();

        return response()->json(['message' => 'Text deleted successfully']);
    }

    public function generate(Request $request): JsonResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'lang_option_id' => 'required|integer|exists:lang_options,id',
            'deck_id' => 'nullable|integer',
        ]);

        $title = $request->title;
        $description = $request->description;
        $lang_option_id = $request->lang_option_id;
        $deck_id = $request->deck_id;

        $result = $this->createAPIRequest($title, $description, $lang_option_id, $deck_id);

        return response()->json(Text::with('langOption')->find($result['id']), 201);
    }

    private function createAPIRequest(string $title, string $textDescription, int $lang_option_id, ?int $deck_id): array
    {
        $languageOption = LangOption::findOrFail($lang_option_id);
        $langdifficulty = $languageOption->difficulty;
        $targetLanguage = $languageOption->language_name;

        $wordlistJSON = null;
        if ($deck_id) {
            $wordList = WordList::where('id', $deck_id)
                ->where('created_by', Auth::id())
                ->first();

            if ($wordList) {
                $words = Word::where('word_list_id', $deck_id)
                    ->get(['base_word', 'target_word'])
                    ->toArray();

                $wordlistJSON = [
                    'Title' => $wordList->name,
                    'Description' => $wordList->description ?? '',
                    'Words' => array_map(function ($word) {
                        return [
                            'Base' => $word['base_word'],
                            'Ziel' => $word['target_word'],
                        ];
                    }, $words),
                ];
            }
        }

        $prompt = $this->generateStoryPrompt($targetLanguage, $langdifficulty, $textDescription, $title, $wordlistJSON);

        $client = OpenAI::client(env('OPENAI_SECRET_KEY'));

        $apiResponse = $client->chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful assistant that creates stories for language learners.'],
                ['role' => 'user', 'content' => $prompt],
            ],
            'temperature' => 0.7,
        ]);

        $storyContent = $apiResponse['choices'][0]['message']['content'];
        $parsedResponse = $this->parseStoryResponse($storyContent);

        $newText = new Text();
        $newText->title = $parsedResponse['title'];
        $newText->text = $parsedResponse['story'];
        $newText->lang_option_id = $lang_option_id;
        $newText->created_by = auth()->id();
        $newText->save();

        ApiUsageLog::create([
            'user_id' => Auth::id(),
            'text_id' => $newText->id,
            'prompt_tokens' => $apiResponse['usage']['prompt_tokens'],
            'completion_tokens' => $apiResponse['usage']['completion_tokens'],
        ]);

        return array_merge($parsedResponse, ['id' => $newText->id]);
    }

    private function generateStoryPrompt(string $targetLanguage, ?string $level, string $storyTopic, string $title, ?array $wordlistJSON): string
    {
        $basePrompt = "
        Create an engaging story in {$targetLanguage} based on the following topic and requirements:
        
        Topic and Special Requirements: \"{$storyTopic}\"
        
        Note: The topic and requirements above may be provided in any language, but your task is to write the story entirely in {$targetLanguage}. Pay close attention to any specific instructions regarding grammar, tense, or other linguistic aspects mentioned in the topic.
        
        The story should be appropriate for language learners at the {$level} level.
        Ensure the story uses vocabulary and grammar structures suitable for this level, while also incorporating any specific grammatical requirements mentioned in the topic (e.g., using a particular tense).
        
        Guidelines:
        1. Write the entire story in {$targetLanguage}, regardless of the language of the provided topic and requirements.
        2. Strictly adhere to any grammatical or structural requirements specified in the topic (such as using a specific tense or focusing on particular grammar points).
        3. Use clear and concise language appropriate for {$level} learners.
        4. Include a variety of sentence structures typical for {$level}, unless the topic specifies a focus on particular structures.
        5. Ensure the story has a clear beginning, middle, and end.
        6. Aim for a story length of approximately 250-300 words. Feel free to aim for a shorter story if the user requests it in their requirements.
        7. Do not include the title \"{$title}\" in the story text itself.
        ";

        if ($wordlistJSON) {
            $wordIntegration = "
        Additionally, you must incorporate the following word list into the story:
        
        " . json_encode($wordlistJSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "
        
        Important notes about word usage:
        - Interpret the word list carefully.
        - Include as many words or concepts from this list as possible in the story.
        - You have the flexibility to use different forms of the words as appropriate.
        - The goal is to include the words or their concepts naturally within the story's context.
        ";
            $basePrompt .= $wordIntegration;
        }

        $basePrompt .= "\nPlease provide the story in {$targetLanguage}, ensuring you follow all specified requirements. Provide the output in the following format:
        
        Title: [Your Title Here]
        
        Story:
        [Your Story Here]";

        return $basePrompt;
    }

    private function parseStoryResponse(string $storyContent): array
    {
        $title = 'Untitled';
        $story = $storyContent;

        if (preg_match('/Title:\s*(.*)\n\nStory:\s*(.*)/s', $storyContent, $matches)) {
            $title = trim($matches[1]);
            $story = trim($matches[2]);
        }

        return [
            'title' => $title,
            'story' => $story,
        ];
    }
}
