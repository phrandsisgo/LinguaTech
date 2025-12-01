use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

<?php

namespace App\Http\Controllers;


class FlaskConnectController extends Controller
{
    /**
     * Display the Flask connection form.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('api-stuff.flaskConnection');
    }

    /**
     * Generate podcast episode by forwarding data to Flask API.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function generate(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'wordInput' => 'required|string',
            'base_language_main' => 'required|string|max:2',
            'target_language_main' => 'required|string|max:2',
            'level_main' => 'required|string|in:A1,A2,B1,B2,C1,C2',
        ]);

        try {
            // Parse JSON word pairs
            $wordPairs = json_decode($validated['wordInput'], true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                return back()->withErrors(['wordInput' => 'Invalid JSON format'])->withInput();
            }

            // Prepare data for Flask API
            $payload = [
                'word_pairs' => $wordPairs,
                'base_language' => $validated['base_language_main'],
                'target_language' => $validated['target_language_main'],
                'level' => $validated['level_main'],
            ];

            // Send request to Flask API
            $flaskUrl = 'http://127.0.0.1:5000/generate-podcast'; // Update this endpoint as needed
            $response = Http::timeout(60)->post($flaskUrl, $payload);

            if ($response->successful()) {
                return back()->with('success', 'Podcast episode generated successfully!');
            }

            Log::error('Flask API error', ['response' => $response->body()]);
            return back()->withErrors(['error' => 'Failed to generate podcast episode'])->withInput();

        } catch (\Exception $e) {
            Log::error('Error connecting to Flask API', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Connection error: ' . $e->getMessage()])->withInput();
        }
    }
}