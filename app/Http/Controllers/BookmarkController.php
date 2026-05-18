<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'book_id' => 'required|string',
            'user_id' => 'required|string', // From Clerk
            'title' => 'nullable|string',
            'author' => 'nullable|string',
            'thumbnail' => 'nullable|string',
        ]);

        $bookmark = Bookmark::where('user_id', $request->user_id)
            ->where('book_id', $request->book_id)
            ->first();

        if ($bookmark) {
            $bookmark->delete();
            return response()->json(['status' => 'removed']);
        }

        Bookmark::create($request->all());
        return response()->json(['status' => 'added']);
    }

    public function index(Request $request)
    {
        // This will be used for the 'Vault' / 'Borrowed' page
        $userId = $request->query('user_id');
        if (!$userId) {
            return view('books.borrowed', ['bookmarks' => []]);
        }

        $bookmarks = Bookmark::where('user_id', $userId)->latest()->get();
        return view('books.borrowed', compact('bookmarks'));
    }

    public function count(Request $request)
    {
        $userId = $request->query('user_id');
        if (!$userId) {
            return response()->json(['count' => 0, 'dibaca' => 0, 'jam' => 0]);
        }

        $count = Bookmark::where('user_id', $userId)->count();
        $dibaca = $count * 2 + 5; // Simulated dynamic read data based on rak
        $jam = $count * 18; // Simulated dynamic hours read based on rak
        
        return response()->json(['count' => $count, 'dibaca' => $dibaca, 'jam' => $jam]);
    }
}
