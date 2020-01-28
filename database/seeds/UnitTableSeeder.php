<?php

use Illuminate\Database\Seeder;

class UnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       	$roles = [
            [
                'name' => 'kg',
                'description' => 'Kilo',
            ],
            [
                'name' => 'l',
                'description' => 'Liter',
            ],
            [
                'name' => 'g',
                'description' => 'Gram',
            ],
            [
                'name' => 'm',
                'description' => 'Meter',
            ],
            [
                'name' => 'piece',
                'description' => 'Piece',
            ],
        ];

        foreach ($roles as $key => $value) {
            App\Unit::create($value);
        }
    }
}
