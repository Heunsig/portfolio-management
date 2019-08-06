<?php

use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert([
            'name' => 'Heunsig',
            'email' => 'heun3344@gmail.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
