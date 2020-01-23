<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
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
                'name' => 'super-admin',
            ],
            [
                'name' => 'admin',
            ],
            [
                'name' => 'editor',
            ],
            [
                'name' => 'customer',
            ],
        ];


        foreach ($roles as $key => $value) {
            \Spatie\Permission\Models\Role::create($value);
        }
    }
}
