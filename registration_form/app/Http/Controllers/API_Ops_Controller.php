<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class API_Ops_Controller extends Controller
{
    public function getActors(Request $request){
        // Check if birthdate is provided
        if (!$request->has('month') || !$request->has('day')) {
            return response()->json(['error' => 'Please provide a birthdate'], 400);
        }

        if ($request->input('month') === "undefined" || $request->input('day') === "undefined") {
            return response()->json(['error' => 'Please provide a birthdate'], 400);
        }
    
        $year = date('Y');
        $month = $request->input('month');
        $day = $request->input('day');
        $stringBirthdate = $year . '-' . $month . '-' . $day;

         
        // Convert the birthdate string into a date object
        $birthdate = strtotime($stringBirthdate);
    

        // Check if the conversion was successful
        if ($birthdate === false) {
            return response()->json(['error' => 'Invalid birthdate format'], 400);
        }
        
        $apiKey = env('ACTORS_API_KEY');
        
        $response = Http::withHeaders([
            'X-RapidAPI-Host' => 'imdb188.p.rapidapi.com',
            'X-RapidAPI-Key' => $apiKey // Replace with your actual API key
        ])->get("https://imdb188.p.rapidapi.com/api/v1/getBornOn", [
            'month' => $month,
            'day' => $day
        ]);

        if ($response->successful()) {
            $list = $response->json()['data']['list'];
            $actors = [];
            foreach ($list as $actor) {
                $actors[] = $actor['nameText']['text'];
            }
            return response()->json($actors);
        } else {
            return response()->json(['error' => 'Failed to fetch data from the API. Please try again later.'], 500);
        }
    }
}