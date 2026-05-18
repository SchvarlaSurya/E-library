<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    private $clerkSecretKey;

    public function __construct()
    {
        $this->clerkSecretKey = env('CLERK_SECRET_KEY');
        
        if (empty($this->clerkSecretKey)) {
            Log::error('CLERK_SECRET_KEY is not set in environment variables');
        }
    }

    public function index()
    {
        $usersResponse = Http::withToken($this->clerkSecretKey)
            ->get('https://api.clerk.com/v1/users');

        $users = $usersResponse->json();

        if (!empty($users)) {
            Log::info('Clerk User Structure:', array_slice($users, 0, 1));
        }

        $books = Book::latest()->get();

        return view('admin.dashboard', [
            'users' => $users,
            'books' => $books,
            'clerk_pk' => env('CLERK_PUBLISHABLE_KEY'),
        ]);
    }

    public function updateUserRole(Request $request, $userId)
    {
        $request->validate([
            'role' => 'required|string|in:admin,member'
        ]);

        try {
            $response = Http::withToken($this->clerkSecretKey)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ])
                ->patch("https://api.clerk.com/v1/users/{$userId}", [
                    'public_metadata' => [
                        'role' => $request->role
                    ]
                ]);

            Log::info('Clerk API Response:', [
                'status' => $response->status(),
                'body' => $response->body(),
                'user_id' => $userId,
                'new_role' => $request->role
            ]);

            if ($response->successful()) {
                return back()->with('success', 'Role user berhasil diperbarui menjadi ' . $request->role . '!');
            } else {
                Log::error('Clerk API Error:', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return back()->withErrors(['error' => 'Gagal update role: ' . $response->body()]);
            }

        } catch (\Exception $e) {
            Log::error('Update Role Exception:', [
                'message' => $e->getMessage(),
                'user_id' => $userId,
                'role' => $request->role
            ]);
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function storeBook(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'cover_url' => 'nullable|url',
        ]);

        Book::create($data);

        return back()->with('success', 'Buku baru berhasil ditambahkan!');
    }
}
