<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Library;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function creer(){
        $categories = Category::all();
        return view('book/creer', ['categories' => $categories]);
    }

    public function creerSubmit(Request $request){
        $this->validate($request, [
            'isbn' => 'required|digits:13',
            'title' => 'required|max:256',
            'authors' => 'required|max:1024',
            'editor' => 'required|max:1024',
            'summary' => 'required'
        ]);
        $new_book = new Book();
        $new_book->setISBN($request['isbn']);
        $new_book->setTitle($request['title']);
        $new_book->setAuthors($request['authors']);
        $new_book->setEditor($request['editor']);
        $new_book->setSummary($request['summary']);
        $new_book->setCategoryID($request['category']);
        $new_book->setOwnerID(Auth::id());
        $new_book->save();
        $library = Library::where('user_id', Auth::id())->first();
        $library->books()->attach($new_book);
        $library->save();
        return redirect()->route('bibliotheque.personnelle');
    }

    public function consulter($id = null){
        $book = Book::find($id);
        $tabNotes = [];
        $notes = Note::where('book_id', $id)->get();
        foreach($notes as $note){
            $user = User::find($note->user_id);
            $tab = ['note' => $note, 'user' => $user];
            $tabNotes[] = $tab;
        }
        return view('book/consulter', ['book' => $book, 'notes' => $tabNotes]);
    }

    public function ajouter($id = null){
        $book = Book::find($id);
        $user_id = Auth::id();
        $library = Library::where('user_id', $user_id)->first();
        $library->books()->attach($book);
        $library->save();
        return redirect()->back();
    }

    public function retirer($id = null){
        $book = Book::find($id);
        $user_id = Auth::id();
        $library = Library::where('user_id', $user_id)->first();
        $library->books()->detach($book);
        $library->save();
        return redirect()->back();
    }

    public function editer($id = null){
        $book = Book::find($id);
        $categories = Category::all();
        return view('book/editer', ['book' => $book, 'categories' => $categories]);
    }

    public function editerSubmit(Request $request){
        $this->validate($request, [
            'isbn' => 'required|digits:13',
            'title' => 'required|max:256',
            'authors' => 'required|max:1024',
            'editor' => 'required|max:1024',
            'summary' => 'required'
        ]);
        Book::find($request['id'])->update([
            'isbn' => $request['isbn'],
            'title' => $request['title'],
            'authors' => $request['authors'],
            'editor' => $request['editor'],
            'summary' => $request['summary'],
            'category_id' => $request['category']
        ]);
        return redirect()->route('bibliotheque.principale');
    }

    public function noter(Request $request){
        $book = Book::find($request['id']);
        return view('book/noter', ['book' => $book]);
    }

    public function noterSubmit(Request $request){
        $new_note = new Note();
        if($request['commentaire'] == null){ $new_note->setCommentaire(""); }
        else{ $new_note->setCommentaire($request['commentaire']); }
        $new_note->setNote($request['note']);
        $new_note->setBookId($request['id']);
        $new_note->setUserID(Auth::id());
        $new_note->save();
        return redirect()->route('bibliotheque.personnelle');
    }
}
