<?php namespace Ubt\Models;

use App\User;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class Book extends Eloquent{
    protected $table = "books";

    protected $fillable  = ['title','content','isbn','copies','author_id'];

    public function author(){
        return $this->belongsTo('Ubt\Models\Author','author_id');
    }

    public function scopelatestBooks($query){
        return $query->orderBy('id','desc')->take(3);
    }

    public function reading(){
        return $this->belongsToMany('App\User', 'books_users', 'books_id', 'users_id');
    }

    public function read($user_id,$book_id){
        $user = User::find($user_id);
        $book = Book::find($book_id);

        $bookReadedTimes = $book->reading()->count();
        $thisUsersIsReading = $user->reading()->where('books_id','=',$book_id)->count();

        if($book->copies <= $bookReadedTimes || $thisUsersIsReading >= 1){
            throw new \Exception("This book is either being readed by this user, or we don't have that number of copies");
        }
        $user->reading()->attach($book_id);
        Event::fire("book.reading",[[$user,$book]]);
    }
} 