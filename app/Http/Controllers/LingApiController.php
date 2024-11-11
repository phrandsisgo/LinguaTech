<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\WordList;
use App\Models\Text;
use App\Models\LangOption;
use OpenAI;
use App\Models\Word;



class LingApiController extends Controller
{
    public function translate(Request $request){
        $text = $request->input('word');
        $targetLang = $request->input('targetLang');
        $sourceLang = $request->input('baseLang');

        $response = Http::asForm()->withHeaders([
            'Authorization' => 'DeepL-Auth-Key ' . env('DEEPL_API_KEY'),
            //'Content-Type' => 'application/x-www-form-urlencoded'
        ])->post('https://api-free.deepl.com/v2/translate', [
            'text' => $text,
            'target_lang' => $targetLang,
            'source_lang' => $sourceLang,
        ]);

        $translation = $response->json()['translations'][0]['text'];

        return response()->json(['translation' => $translation, 'request' => $text]);
    }
    public function textPlay(){
        $ownLibraryList = WordList::where('created_by', auth()->user()->id)->get();
        $allTexts = Text::with("langOption")->get();

        return view('api-stuff/textPlay',['ownLibraryList' => $ownLibraryList, 'allTexts' => $allTexts]);
    }
    public function textShow($id){
        $text = Text::with("langOption")->find($id);
        $allTexts = Text::with("langOption")->get();
        $ownLibraryList = WordList::where('created_by', auth()->user()->id)->get();
        return view('api-stuff/textShow',['text' => $text, 'allTexts' => $allTexts, 'ownLibraryList' => $ownLibraryList]);
    }
    public function destroyText(Request $request,){
        $id = $request->input('textId');
        $text = Text::find($id);
        if (!$text) {
            return redirect()->back()->with('error', 'Text not found.');
        }
        //check if userid and $text created_by are the same
        if ($text->created_by != auth()->user()->id) {
            return abort(403, "unauthorized");
        }
        $text->delete();
        return redirect('/textPlay');
    }
    
    public function displayAllTexts(){
        $allTexts = Text::with("langOption")->get();
        return view('api-stuff/displayAllTexts',['allTexts' => $allTexts]);
    }
    public function addText(){
        $languages = LangOption::whereBetween('id', [2, 8])->get();
        return view('api-stuff/newText',['languages' => $languages]);
    }
    public function updateText($id){
        $text = Text::with("langOption")->find($id);
        $languages = LangOption::whereBetween('id', [2, 8])->get();
        return view('api-stuff/updateTexts',['text' => $text, 'languages' => $languages]);
    }

    public function generateTextView(){
        $languages = LangOption::whereBetween('id', [2, 8])->get();
        $decks = WordList::where('created_by', auth()->user()->id)->get();
        return view('api-stuff/generateText',['languages' => $languages, 'decks' => $decks]);
    }

    public function generateText(Request $request){
        //dd("this is the request {$request->input('add-text-field')}");
        $title = $request->input('title');
        $text = $request->input('add-text-field');
        $lang_option_id = $request->input('lang_option_id');
        $deck_id = $request->input('deck_id');
    
        $response = $this->createAPIRequest($title, $text, $lang_option_id, $deck_id);
        $newText = new Text();
        $newText->title = $response['title'];
        $newText->text = $response['story'];
        $newText->lang_option_id = $lang_option_id;
        $newText->created_by = auth()->user()->id;
        $newText->save();
        $text_id = $newText->id;

    
        return redirect('/textShow/'.$text_id);
    }

    public function updateTextFunction(Request $request){
        $id = $request->input('id');
        $text = Text::find($id);

        if (!$text) {
            return redirect()->back()->with('error', 'Text not found.');
        }
        //check if userid and $text created_by are the same
        if ($text->created_by != auth()->user()->id) {
            return abort(403, "unauthorized");
        }
        $text->title = $request->input('title');
        $text->text = $request->input('text');
        $text->lang_option_id = $request->input('lang');
        $text->updated_at = now();
        $text->save();
        return redirect('/textShow/'.$id);
    }
    //wurde noch nicht getestet:
    public function createNewText(Request $request){
        $text = new Text();
        $text->title = $request->input('title');
        $text->text = $request->input('add-text-field');
        $text->lang_option_id = $request->input('lang')[0];
        $text->created_by = auth()->user()->id;
        $text->save();
        $text_id = $text->id;
        return redirect('/textShow/'.$text_id);
    }

    private function createAPIRequest($title, $textDescription, $lang_option_id, $deck_id)
    {
        // Get the target language from lang_option_id
        $languageOption = LangOption::find($lang_option_id);
        $langdifficulty = $languageOption->difficulty;
        $targetLanguage = $languageOption ? $languageOption->language_name : 'English';
    
        // Retrieve words from the user's deck if deck_id is provided
        $wordlistJSON = null;
        if ($deck_id) {
            $wordList = WordList::where('id', $deck_id)
                ->where('created_by', Auth::id())
                ->first();
    
            if ($wordList) {
                // Retrieve words with base and target words
                $words = Word::where('word_list_id', $deck_id)
                    ->get(['base_word', 'target_word'])
                    ->toArray();
    
                // Build the JSON structure
                $wordlistJSON = [
                    'Title' => $wordList->name,
                    'Description' => $wordList->description ?? '',
                    'Words' => array_map(function($word) {
                        return [
                            'Base' => $word['base_word'],
                            'Ziel' => $word['target_word'],
                        ];
                    }, $words),
                ];
            }
        }
    
        // Generate the prompt
        //intermediate has to be swapped for the level of$languageOption
        $prompt = $this->generateStoryPrompt($targetLanguage, $langdifficulty, $textDescription, $title, $wordlistJSON);
    
        // Initialize the OpenAI client
        $client = OpenAI::client(env('OPENAI_SECRET_KEY'));
        //dd("das ist der Prompt:  {$prompt}");
    
        // Make the API call using Chat Completion endpoint
        $apiResponse = $client->chat()->create([
            'model' => 'gpt-4o-mini', // Use the model you have access to
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful assistant that creates stories for language learners.'],
                ['role' => 'user', 'content' => $prompt],
            ],
            'temperature' => 0.7,
        ]);
    
        // Extract the response
        $storyContent = $apiResponse['choices'][0]['message']['content'];
    
        // Parse the response to separate title and story
        $parsedResponse = $this->parseStoryResponse($storyContent);
    
        return $parsedResponse; // ['title' => ..., 'story' => ...]
    }

    private function generateStoryPrompt($targetLanguage, $level, $storyTopic, $title, $wordlistJSON = null)
    {
        //dd("this is the target language: {$storyTopic}");
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
    7. Mention the title \"{$title}\" in the story in a way that it is clear this is the title the user wished for. At the end of the story, translate the title into {$targetLanguage}.
    ";
    
        if ($wordlistJSON) {
            $wordIntegration = "
    Additionally, you must incorporate the following word list into the story:
    
    " . json_encode($wordlistJSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "
    
    Important notes about word usage:
    - Interpret the word list carefully.
    - Include as many words or concepts from this list as possible in the story.
    - You have the flexibility to use different forms of the words as appropriate:
      - For verbs: You may conjugate them or use different tenses as needed, ensuring consistency with any tense requirements specified in the topic.
      - For nouns: You may use singular or plural forms.
      - For adjectives: You may use comparatives or superlatives if it fits the context.
    - The goal is to include the words or their concepts naturally within the story's context.
    - Use these words or their variations in a way that helps illustrate their meaning.
    ";
            $basePrompt .= $wordIntegration;
        }
    
        $basePrompt .= "\nPlease provide the story in {$targetLanguage}, ensuring you follow all specified requirements. Provide the output in the following format:
    
    Title: [Your Title Here]
    
    Story:
    [Your Story Here]";
    
        return $basePrompt;
    }
    

    private function parseStoryResponse($storyContent)
    {
        // Parse the AI response to extract the title and story
        $title = 'Untitled';
        $story = $storyContent;

        // Use regular expressions to find the title and story
        if (preg_match('/Title:\s*(.*)\n\nStory:\s*(.*)/s', $storyContent, $matches)) {
            $title = trim($matches[1]);
            $story = trim($matches[2]);
        }

        return [
            'title' => $title,
            'story' => $story,
        ];
    }

    public function showLandingPage()
    {
        $userId = Auth::id();

        // Get last 5 decks created by the user
        $decks = WordList::where('created_by', $userId)
            ->orderBy('updated_at', 'desc')
            ->take(3)
            ->get();

        // Get last 5 texts created by the user
        $texts = Text::where('created_by', $userId)
            ->orderBy('updated_at', 'desc')
            ->take(3)
            ->get();

        return view('playground', compact('decks', 'texts'));
    }

}
