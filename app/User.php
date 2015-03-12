<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Ubt\Models\Book;


class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token', 'administrator'];

    public function reading(){
        return $this->belongsToMany('Ubt\Models\Book', 'books_users', 'users_id', 'books_id');
    }

    public function isAdmin(){
        return $this->administrator;
    }

    public function isReading(Book $book){
        $bookID = $book->id;
        return $this->whereHas('reading',function($q) use ($bookID) {
            $q->where("id","=",$bookID);
        })->get()->count() ? true : false;
    }
}
