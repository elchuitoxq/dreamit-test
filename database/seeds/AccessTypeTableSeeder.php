<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccessTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $access = array(
            array(
                'message' => 'Accesso concedido',
                'access' => true
            ),
            array(
                'message' => 'Acesso restringido el usuario esta en la Lista de Bloqueo',
                'access' => false
            )
        );

        DB::table('access_types')->insert($access);
    }
}
