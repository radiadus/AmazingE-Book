<?php

namespace App\Http\Controllers;

use App\Models\EBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EBookController extends Controller
{
    public function show(){
        $ebooks = EBook::all();

        return view('home', compact('ebooks'));
    }

    public function getEBook($id){

        $ebook = DB::table('e_books')
                ->select('e_books.*')
                ->where('e_books.ebook_id', $id)
                ->first();

        return view('ebookdetail', compact('ebook'));
    }
}
