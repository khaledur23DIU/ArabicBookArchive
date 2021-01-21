<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'list',
           'create',
           'edit',
           'delete'
        ];

        $modules = [
          'user',
          'role',
          'country-list',
          'language-list',
          'mazhab',
          'personCategory-list',
          'person-list',
          'bookCategory',
          'book-list',
          'library-list',
          'publication-info',
          'place-list',
          'BookBasicInfo',
          'Manuscript',
          'PublishedBook',
          'settings',
        ];

         foreach ($modules as $key => $module) {
           foreach ($permissions as $permission) {
                   Permission::create(['module' => $module, 'name' => $module.'-'.$permission]);
              }
         }
        
    }
}
