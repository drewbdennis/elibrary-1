<?php namespace Ubt\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\DB;

class Author extends Eloquent{
    protected $table = "authors";

    protected $fillable  = ['name','born','dead'];

    public function books(){
        return $this->hasMany('Ubt\Models\Book','author_id');
    }

    public static function getPopularAuthors(){
        $query = DB::select('select count(authors.id) as booksRode ,authors.name, authors.id from authors
                                          inner join books
                                          on authors.id = books.author_id
                                           inner join books_users
                                           on books.id = books_users.books_id
                                        group by authors.id
                                        order by booksRode DESC
                                        limit 3');
        return $query;
    }
} 