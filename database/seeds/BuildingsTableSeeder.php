<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuildingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $buildings = array(
            array(
                'name' => 'Magdalena Vicuña',
                'address' => 'Magdalena Vicuña 1442'
            ),
            array(
                'name' => 'Toro Masote',
                'address' => 'Toro Masote 110'
            )
        );

        DB::table('buildings')->insert($buildings);
    }
}
