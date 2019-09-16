<?php

use Illuminate\Database\Seeder;

use App\User;

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
        $user  = User::all();

        if($user->isEmpty()) {
            User::create([
                'vorname' => 'Paul',
                'nachname' => 'Test',
                'email' => 'paul@test.de',
                'password' => bcrypt('jannes')
            ]);
        }
    }
}
