<?php

use UBT\Models\Author;
use Carbon;
use Illuminate\Database\Seeder;

class AuthorsTableSeeder extends Seeder{
    public function run()
    {
        DB::table('authors')->delete();

        Author::create(array(
            'name' => 'Fyodor Dostoyevsky',
            'born' => Carbon::createFromDate(1821,11,11),
            'dead' => Carbon::createFromDate(1881,2,9)
        ));

        Author::create(array(
            'name' => 'Charles Bukowski',
            'born' => Carbon::createFromDate(1920 ,7,16),
            'dead' => Carbon::createFromDate(1994,3,9)
        ));
    }
} 