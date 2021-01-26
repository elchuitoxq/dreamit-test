<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array(
            array(
                'role' => 'Administrador',
            ),
            array(
                'role' => 'Persona'
            )
        );

        DB::table('roles')->insert($roles);
    }
}
