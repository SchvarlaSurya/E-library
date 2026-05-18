<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        Book::create([
            'title' => 'Streetwear Culture Vol 1',
            'author' => 'Hypebeast Editor',
            'description' => 'The evolution of street fashion from Tokyo to NYC.',
            'cover_url' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=500', // Placeholder cover
            'file_path' => null, // Nanti diisi kalau udah ada PDF
            'category' => 'Fashion'
        ]);

        Book::create([
            'title' => 'Minimalist Design Principles',
            'author' => 'Dieter Rams',
            'description' => 'Good design is as little design as possible.',
            'cover_url' => 'https://images.unsplash.com/photo-1589998059171-988d887df646?w=500',
            'file_path' => null,
            'category' => 'Design'
        ]);
    }
}