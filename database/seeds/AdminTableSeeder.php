<?php

use App\Admin;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var Collection $administrators */
        $admin  = Admin::all();

        if($admin->isEmpty()) {
            Admin::create([
                'vorname' => 'Paul',
                'nachname' => 'Test',
                'email' => 'admin@mws.de',
                'password' => bcrypt('123456')
            ]);
        }
    }
}
