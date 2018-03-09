<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = Role::create([
            'name' => 'Administrator',
            'slug' => 'administrator',
            'permissions' => [
                'create-product' => true,
                'update-product' => true,
                'delete-product' => true,
                'see-all-drafts' => true,
                'access-manager' => true
            ]
        ]);
        $manager = Role::create([
            'name' => 'Manager',
            'slug' => 'manager',
            'permissions' => [
                'create-product' => true,
                'update-product' => true,
                'delete-product' => true,
                'see-all-drafts' => true,
                'access-manager' => true
            ]
        ]);
        $salesman = Role::create([
            'name' => 'Salesman',
            'slug' => 'salesman',
            'permissions' => [
                'access-manager' => true
            ]
        ]);
    }
}
