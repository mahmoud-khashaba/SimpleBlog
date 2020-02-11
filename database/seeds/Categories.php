<?php

use Illuminate\Database\Seeder;
use App\Category;
use Illuminate\Support\Str;

class Categories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
        	[
        	'id'=>(string) Str::uuid(),
        	'name'=>'general',
        	'slug'=>'general',
        	],
        	[
			'id'=>(string) Str::uuid(),
        	'name'=>'featured',
        	'slug'=>'featured',
        	],
        	[
        	'id'=>(string) Str::uuid(),	
        	'name'=>'trending',
        	'slug'=>'trending',
        	]
    	]);
    }
}
