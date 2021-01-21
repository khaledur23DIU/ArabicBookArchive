<?php

use App\MazhabTypeList;
use Illuminate\Database\Seeder;

class MazhabTypeListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MazhabTypeList::create([
        	'mazhabType' => 'Mazhab (Fikh)'
        ]);

        MazhabTypeList::create([
        	'mazhabType' => 'Mazhab (Akida)'
        ]);
    }
}
