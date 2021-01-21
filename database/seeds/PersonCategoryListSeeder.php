<?php

use App\PersonCategoryList;
use Illuminate\Database\Seeder;

class PersonCategoryListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PersonCategoryList::create([
        	'person_category' => 'Author'
        ]);

        PersonCategoryList::create([
        	'person_category' => 'Writer'
        ]);

        PersonCategoryList::create([
        	'person_category' => 'Editor'
        ]);

        PersonCategoryList::create([
        	'person_category' => 'Teacher'
        ]);

        PersonCategoryList::create([
        	'person_category' => 'Student'
        ]);

        PersonCategoryList::create([
        	'person_category' => 'Owner'
        ]);

        PersonCategoryList::create([
            'person_category' => 'Publisher'
        ]);
    }
}
