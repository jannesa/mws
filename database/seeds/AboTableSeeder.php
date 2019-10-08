<?php

use Illuminate\Database\Seeder;
use App\Abo;

class AboTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $abo = Abo::all();

        if($abo->isEmpty()) {
            Abo::create([
                'abo_typ' => 'Free',
                'abo_laenge' => 12,
                'abo_preis' => 0,
                'aktive_events' => 2,
                'inaktive_events' => 5,
                'buchungsbeginn' => \Carbon\Carbon::now(),
                'zahlungsart' => 'PayPal',
                'zahlungsrhythmus' => ' vierteljährlich'
            ]);

            Abo::create([
                'abo_typ' => 'Pro',
                'abo_laenge' => 12,
                'abo_preis' => 3,
                'aktive_events' => 10,
                'inaktive_events' => 20,
                'buchungsbeginn' => \Carbon\Carbon::now(),
                'zahlungsart' => 'PayPal',
                'zahlungsrhythmus' => ' vierteljährlich',
            ]);

            Abo::create([
                'abo_typ' => 'Premium',
                'abo_laenge' => 12,
                'abo_preis' => 7,
                'aktive_events' => 1000,
                'inaktive_events' => 1000,
                'buchungsbeginn' => \Carbon\Carbon::now(),
                'zahlungsart' => 'PayPal',
                'zahlungsrhythmus' => ' vierteljährlich'
            ]);

        }
    }
}
