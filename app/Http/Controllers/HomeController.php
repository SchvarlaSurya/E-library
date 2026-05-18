<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category', 'fiction');

        $queryStr = $category === 'All' ? 'novel' : 'subject:' . strtolower($category);

        $response = Http::withoutVerifying()->get('https://www.googleapis.com/books/v1/volumes', [
            'q' => $queryStr,
            'orderBy' => 'relevance',
            'maxResults' => 12
        ]);

        $items = $response->json()['items'] ?? [];

        $hotBooks = collect($items)->filter(function ($item) {
            return isset($item['volumeInfo']) && isset($item['volumeInfo']['imageLinks']);
        })->take(12)->toArray();

        return view('home', [
            'hotBooks' => $hotBooks,
            'activeCategory' => $category,
            'clerk_pk' => env('CLERK_PUBLISHABLE_KEY'),
        ]);
    }
}