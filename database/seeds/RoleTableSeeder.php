<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'admin',
            'description' => 'Can access all user',
        ]);

        Role::create([
            'name' => 'user',
            'description' => 'Can access own account',
        ]);
        
    }

}
