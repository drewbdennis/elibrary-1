<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Ubt\Models\Author;

class AuthorsController extends Controller {

    protected $author;
    protected $carbon;
    public function __construct(Author $author, Carbon $carbon){
        $this->author = $author;
        $this->carbon = $carbon;
    }
    /**
     * Manage all authors
     *
     * @return view
     */
    public function manage(){
        $authors = $this->author->all();
        return view('author.manage',compact("authors"));
    }
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        $input = $request->all();
        $input['born'] = $this->carbon->parse($input['born']);
        $input['dead'] = $input['dead'] ? $this->carbon->parse($input['dead']) : "";
		$this->author->create($input);
        return Redirect::to(route('authors.manage'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$author = $this->author->find($id);
        return view("author.edit",compact('author'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id,Request $response)
	{
        $author = $this->author->find($id);
        $author->name = $response->get('name');
        $author->born = $this->carbon->parse($response->get('born'));
        $author->dead = $response->get('dead') ? $this->carbon->parse($response->get('dead')) : "";
        $author->save();
        return Redirect::to(route('authors.manage'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$author = $this->author->find($id);
        $books = $author->books()->select('id')->get()->toArray();

        //Delete all reading relationships
        DB::table('books_users')->whereIn('books_id',$books)->delete();
        //Delete all books now
        $author->books()->delete();
        //Delete the author
        $author->delete();

        return Redirect::to(route('authors.manage'));
	}

}
