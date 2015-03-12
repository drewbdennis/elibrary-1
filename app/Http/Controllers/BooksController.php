<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Ubt\Models\Author;
use Ubt\Models\Book;

class BooksController extends Controller {

    protected $book;
    protected $author;
    public function __construct(Book $book,Author $author){
        $this->book = $book;
        $this->author = $author;
    }

	/**
	 * Store a newly created resource in storage.
	 *
     * @param Illuminate\Http\Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
        $this->book->create($request->all());
        return Redirect::to(route('books.manage'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$book = $this->book->find($id);
        return view("book.book",compact("book"));
	}


    /**
     * Read a book by current user
     *
     * @param $id
     * @return Illuminate\Support\Facades\Redirect
     */
    public function read($id){
        $userId = Auth::user()->id;
        $this->book->read($userId,$id);
        return Redirect::to("/home");
    }


    /**
     * Return book to library
     *
     * @param $id
     * @return Illuminate\Support\Facades\Redirect
     */
    public function returnBook($id){
        if($this->book->find($id)->first()->count()){
            Auth::user()->reading()->detach($id);
        }
        return Redirect::to("/home");
    }

    /**
     * List books to edit,add or delete them
     *
     * @return \Illuminate\View\View
     */
    public function manage()
    {
        $authors = $this->author->lists('name','id');
        $books = $this->book->orderBy('author_id')->get();
        return view('book.manage',compact(['books','authors']));
    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$book = $this->book->find($id);
        $authors = $this->author->lists('name','id');
        return view("book.edit",compact("book","authors"));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param  @param Illuminate\Http\Request $request  $request
	 * @return Response
	 */
	public function update($id,Request $request)
	{
		$book = $this->book->find($id);
        $book->title = $request->get("title");
        $book->content = $request->get("content");
        $book->isbn = $request->get("isbn");
        $book->copies = $request->get("copies");
        $book->author_id = $request->get("author_id");
        $book->save();
        return Redirect::to(route('books.manage'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        if($this->book->find($id)->first()->count() && $this->book->find($id)->reading()->count() < 1){
            $this->book->find($id)->delete();
        }else{
            throw new \Exception('This book has readers, which means you cant delete it');
        }
        return Redirect::to(route('books.manage'));
	}

}
