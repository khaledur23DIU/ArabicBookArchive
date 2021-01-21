<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
        	'name' => 'Jhon Doe', 
        	'email' => 'admin@gmail.com',
        	'password' => bcrypt('123456')
        ]);
        
        $user->profile()->create([
            'account_status' => true
        ]);
        $role = Role::create(['name' => 'Super Admin']);
   
        $permissions = Permission::pluck('id','id')->all();
  
        $role->syncPermissions($permissions);
   
        $user->assignRole([$role->id]);
    }
}
