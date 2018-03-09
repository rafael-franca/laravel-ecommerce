<?php

use App\User;
use App\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesSeeder::class);

        factory(User::class, 1)
            ->create()
            ->each(
                function ($user) {
                    $user->roles()->attach(1);
                }
            );
        factory(User::class, 1)
            ->create()
            ->each(
                function ($user) {
                    $user->roles()->attach(2);
                }
            );
        factory(User::class, 5)
            ->create()
            ->each(
                function ($user) {
                    $user->roles()->attach(3);
                }
            );
        factory(User::class, 10)
            ->create();
        factory(Product::class, 100)
            ->create();
    }
}
