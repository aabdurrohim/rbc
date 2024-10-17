<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));

    }
    public function create()
    {
        return view("books.create");
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'book_name' => 'required',
            'publisher' => 'required',
            'interest' => 'required',
            'desc' => 'required',
            'isbn' => 'required',
            'author' => 'required',
            'stock' => 'required|numeric',
        ]);

        // Generate book_code
        $number = mt_rand(1000000000, 9999999999);
        while ($this->bookCodeExists($number)) {
            $number = mt_rand(1000000000, 9999999999);
        }

        // Tambahkan book_code ke dalam data
        $data['book_code'] = $number;

        // Simpan buku ke database dengan semua data
        $newBook = Book::create($data);

        return redirect('/');
    }

    public function bookCodeExists($number)
    {
        return book::whereBookCode($number)->exists();
    }
}
