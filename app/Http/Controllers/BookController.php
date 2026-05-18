<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BookController extends Controller
{
    private $apiKey = "AIzaSyCZIkxHfHa_1fp3BTo8qp6t2TT-rCq-BAg";

    public function index(Request $request)
    {
        $query = $request->input('q');
        $category = $request->input('category');

        $searchTarget = 'programming';

        if ($category && $category !== 'All') {
            $searchTarget = "subject:{$category}";
        }
        elseif ($query && strtolower($query) !== 'isbn') {
            $searchTarget = $query;
        }

        $response = Http::withoutVerifying()->get("https://www.googleapis.com/books/v1/volumes", [
            'q' => $searchTarget,
            'maxResults' => 20,
            'orderBy' => 'relevance',
            'key' => $this->apiKey,
        ]);

        $books = $response->json()['items'] ?? [];

        return view('books.library', compact('books', 'query', 'category'));
    }

    public function show($id)
    {
        $response = Http::withoutVerifying()->get("https://www.googleapis.com/books/v1/volumes/{$id}", [
            'key' => $this->apiKey,
        ]);

        if (!$response->successful()) {
            abort(404, 'Book not found.');
        }

        $book = $response->json();
        
        $author = $book['volumeInfo']['authors'][0] ?? null;
        $category = $book['volumeInfo']['categories'][0] ?? null;
        
        $queryParts = [];
        if ($category) $queryParts[] = 'subject:' . urlencode('"' . $category . '"');
        if ($author) $queryParts[] = 'inauthor:' . urlencode('"' . $author . '"');
        
        $searchQuery = count($queryParts) > 0 ? implode('+', $queryParts) : 'novel';

        $similarResponse = Http::withoutVerifying()->get("https://www.googleapis.com/books/v1/volumes", [
            'q' => $searchQuery,
            'maxResults' => 5,
            'orderBy' => 'relevance',
            'key' => $this->apiKey,
        ]);

        $similarBooks = collect($similarResponse->json()['items'] ?? [])
            ->filter(function($b) use ($id) { return $b['id'] !== $id; })
            ->take(4);

        return view('books.show', compact('book', 'similarBooks'));
    }
}