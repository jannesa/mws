<?php

use Illuminate\Database\Seeder;

use App\Usertest;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var Collection $administrators */
        $user  = Usertest::all();

        if($user->isEmpty()) {
            Usertest::create([
                'vorname' => 'Paul',
                'nachname' => 'Test',
                'email' => 'paul@test.de',
                'password' => bcrypt('jannes'),
                'abo_id' => 1
            ]);


            Usertest::create([
                'vorname' => 'J',
                'nachname' => 'A',
                'email' => 'jannes@test.de',
                'password' => bcrypt('12345678'),
                'abo_id' => 2
            ]);

            Usertest::create([
                'vorname' => 'katja',
                'nachname' => 's',
                'email' => 'kat@abc.de',
                'password' => bcrypt('password'),
                'abo_id' => 3
            ]);

            Usertest::create([
                'vorname' => 'sabrina',
                'nachname' => 'g',
                'email' => 'sabrina@abc.de',
                'password' => bcrypt('password'),
                'abo_id' => 1
            ]);
        }
    }
}
