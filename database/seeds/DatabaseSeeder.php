<?php

use Illuminate\Database\Seeder;
use Ubt\Models\Author;
use Ubt\Models\Book;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//Model::unguard();

		$this->call('AuthorsTableSeeder');
	}

}

class AuthorsTableSeeder extends Seeder{
    public function run()
    {
        DB::table('authors')->delete();
        DB::table('books')->delete();
        DB::table('users')->delete();

        $dostoyevski = Author::create(array(
            'name' => 'Fyodor Dostoyevsky',
            'born' => \Carbon\Carbon::createFromDate(1821,11,11),
            'dead' => \Carbon\Carbon::createFromDate(1881,2,9)
        ));

            Book::create(array(
                'title' => 'The idiot',
                'content' => 'Vestibulum rutrum mi nec elementum',
                'isbn' => '978-1420930597',
                'copies' => 5,
                'author_id' => $dostoyevski->id
            ));

            Book::create(array(
                'title' => 'Demons',
                'content' => 'Vestibulum rutrum mi nec elementum',
                'isbn' => '0679734511',
                'copies' => 5,
                'author_id' => $dostoyevski->id
            ));

            Book::create(array(
                'title' => 'Crime and Punishment',
                'content' => 'Vestibulum rutrum mi nec elementum',
                'isbn' => '1613822820',
                'copies' => 5,
                'author_id' => $dostoyevski->id
            ));


        $bukowski = Author::create(array(
            'name' => 'Charles Bukowski',
            'born' => \Carbon\Carbon::createFromDate(1920 ,7,16),
            'dead' => \Carbon\Carbon::createFromDate(1994,3,9)
        ));

            Book::create(array(
                'title' => 'Women',
                'content' => 'Vestibulum rutrum mi nec elementum',
                'isbn' => '1613822820132',
                'copies' => 5,
                'author_id' => $bukowski->id
            ));

            Book::create(array(
                'title' => 'Pulp',
                'content' => 'Vestibulum rutrum mi nec elementum',
                'isbn' => '978-0876859261',
                'copies' => 5,
                'author_id' => $bukowski->id
            ));

        $paulo = Author::create(array(
            'name' => 'Paulo Coelho',
            'born' => \Carbon\Carbon::createFromDate(1947 ,7,24),
            'dead' => null
        ));

            Book::create(array(
                'title' => 'The Witch of Portobello',
                'content' => 'Vestibulum rutrum mi nec elementum',
                'isbn' => '978-0061338816',
                'copies' => 5,
                'author_id' => $paulo->id
            ));

            Book::create(array(
                'title' => 'The Alchemist',
                'content' => 'Vestibulum rutrum mi nec elementum',
                'isbn' => '978-0061122415',
                'copies' => 5,
                'author_id' => $paulo->id
            ));

        $user = \App\User::create(array(
            'name' => 'Burim Shala',
            'email' => 'burimi@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('123456')
        ));
        $user->administrator = true;
        $user->save();
    }
}

class BooksTableSeeder extends Seeder{
    public function run()
    {
        DB::table('books')->delete();

        //Create Dostoyevsky books

    }
}