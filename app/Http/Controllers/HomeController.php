<?php namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Ubt\Models\Author;
use Ubt\Models\Book;

class HomeController extends Controller {

    protected $author;
    protected $book;
    protected $carbon;
	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(Author $author,Book $book,Carbon $carbon)
	{
		$this->middleware('auth');
        $this->author = $author;
        $this->book = $book;
        $this->carbon = $carbon;
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        $latestBooks = $this->book->latestBooks()->get();
        $reading = Auth::user()->reading;
        $popular_authors = $this->author->getPopularAuthors();
		return view('home',compact([ 'latestBooks' , 'reading' , 'popular_authors']));
	}

}
