<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Library;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LibraryController extends Controller
{
    public function verification(){
        $library = Library::where('user_id' , Auth::id())->first();
        if(!empty($library)){
            return redirect()->route('bibliotheque.personnelle');
        }
        return view('library/nom');
    }

    public function nommer(Request $request){
        $this->validate($request, [
            'name' => 'required'
        ]);
        $new_library = new Library();
        $new_library->setName($request['name']);
        $new_library->setUserId(Auth::id());
        $new_library->save();
        return redirect()->route('bibliotheque.personnelle');
    }

    public function personnelle(){
        $writed_books = Book::where('owner_id', Auth::id())->get();
        $library = Library::where('user_id' , Auth::id())->first();
        $books = $library->books()->paginate(10);
        $categories = Category::all();
        return view('library/personnelle', ['books' => $books, 'writed_books' => $writed_books, 'library' => $library, 'categories' => $categories]);
    }

    public function personnelleTri(){
        $data = [];
        $library = Library::where('user_id' , Auth::id())->first();
        $books = $library->books()->when(request('isbn'), function ($q, $isbn) use (&$data) {
            $data['isbn'] = $isbn;
            return $q->where('isbn', 'like', '%' . $isbn . '%');
        })->when(request('title'), function ($q, $title) use (&$data) {
            $data['title'] = $title;
            return $q->where('title', 'like', '%' . $title . '%');
        })->when(request('authors'), function ($q, $authors) use (&$data) {
            $data['authors'] = $authors;
            return $q->where('authors', 'like', '%' . $authors . '%');
        })->when(request('editor'), function ($q, $editor) use (&$data) {
            $data['editor'] = $editor;
            return $q->where('editor', 'like', '%' . $editor . '%');
        })->when(request('category'), function ($q, $category) use (&$data) {
            $data['category'] = $category;
            return $q->where('category_id', $category);
        })->paginate(10);
        $writed_books = Book::where('owner_id', Auth::id())->get();
        $library = Library::where('user_id' , Auth::id())->first();
        $owned_books = $library->books;
        $categories = Category::all();
        return view('library/personnelle', ['books' => $books, 'writed_books' => $writed_books, 'library' => $library, 'owned_books' => $owned_books, 'categories' => $categories, 'data' => $data]);
    }

    public function principale() {
        $ajoutPossible = false;
        $books = Book::paginate(10);
        $writed_books = Book::where('owner_id', Auth::id())->get();
        $library = Library::where('user_id' , Auth::id())->first();
        if(empty($library)){ $owned_books = []; }
        else{
            $owned_books = $library->books;
            $ajoutPossible = true;
        }
        $categories = Category::all();
        return view('library/principale', ['books' => $books, 'writed_books' => $writed_books, 'owned_books' => $owned_books, 'categories' => $categories, 'ajoutPossible' => $ajoutPossible]);
    }

    public function principaleTri(){
        $ajoutPossible = false;
        $data = [];
        $books = Book::query()->when(request('isbn'), function ($q, $isbn) use (&$data) {
            $data['isbn'] = $isbn;
            return $q->where('isbn', 'like', '%' . $isbn . '%');
        })->when(request('title'), function ($q, $title) use (&$data) {
            $data['title'] = $title;
            return $q->where('title', 'like', '%' . $title . '%');
        })->when(request('authors'), function ($q, $authors) use (&$data) {
            $data['authors'] = $authors;
            return $q->where('authors', 'like', '%' . $authors . '%');
        })->when(request('editor'), function ($q, $editor) use (&$data) {
            $data['editor'] = $editor;
            return $q->where('editor', 'like', '%' . $editor . '%');
        })->when(request('category'), function ($q, $category) use (&$data) {
            $data['category'] = $category;
            return $q->where('category_id', $category);
        })->paginate(10);
        $writed_books = Book::where('owner_id', Auth::id())->get();
        $library = Library::where('user_id' , Auth::id())->first();
        if(empty($library)){ $owned_books = []; }
        else {
            $owned_books = $library->books;
            $ajoutPossible = true;
        }
        $categories = Category::all();
        return view('library/principale', ['books' => $books, 'writed_books' => $writed_books, 'owned_books' => $owned_books, 'categories' => $categories, 'ajoutPossible' => $ajoutPossible, 'data' => $data]);
    }

    public function listeAmis(){
        $libraries = User::find(Auth::id())->libraries()->paginate(10);
        $tabUsers = [];
        foreach($libraries as $library){
            $user = User::find($library->user_id);
            $tabUsers[] = $user;
        }
        return view('library/amis', ['libraries' => $libraries, 'users' => $tabUsers]);
    }

    public function autresBibliotheques($id = null){
        $user = User::find($id);
        $library = Library::where('user_id', $id)->first();
        $books = $library->books()->paginate(10);
        $writed_books = Book::where('owner_id', Auth::id())->get();
        $categories = Category::all();
        return view('library/autre', ['books' => $books, 'writed_books' => $writed_books, 'categories' => $categories, 'library' => $library, 'user' => $user]);
    }

    public function autresBibliothequesTri(Request $request){
        $data = [];
        $user = User::find($request['id']);
        $library = Library::where('user_id' , $request['id'])->first();
        $books = $library->books()->when(request('isbn'), function ($q, $isbn) use (&$data) {
            $data['isbn'] = $isbn;
            return $q->where('isbn', 'like', '%' . $isbn . '%');
        })->when(request('title'), function ($q, $title) use (&$data) {
            $data['title'] = $title;
            return $q->where('title', 'like', '%' . $title . '%');
        })->when(request('authors'), function ($q, $authors) use (&$data) {
            $data['authors'] = $authors;
            return $q->where('authors', 'like', '%' . $authors . '%');
        })->when(request('editor'), function ($q, $editor) use (&$data) {
            $data['editor'] = $editor;
            return $q->where('editor', 'like', '%' . $editor . '%');
        })->when(request('category'), function ($q, $category) use (&$data) {
            $data['category'] = $category;
            return $q->where('category_id', $category);
        })->paginate(10);
        $writed_books = Book::where('owner_id', Auth::id())->get();
        $library = Library::where('user_id' , Auth::id())->first();
        $categories = Category::all();
        return view('library/autre', ['books' => $books, 'writed_books' => $writed_books, 'categories' => $categories, 'library' => $library, 'user' => $user, 'data' => $data]);
    }
}
