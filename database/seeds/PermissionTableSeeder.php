<?php

use Illuminate\Database\Seeder;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       	$permissions = [
            [
                'name' => 'user-list',
            ],
            [
                'name' => 'user-show',
            ],
            [
                'name' => 'user-create',
            ],
            [
                'name' => 'user-edit',
            ],
            [
                'name' => 'user-delete',
            ],
            [
                'name' => 'role-list',
            ],
            [
                'name' => 'role-show',
            ],
            [
                'name' => 'role-create',
            ],
            [
                'name' => 'role-edit',
            ],
            [
                'name' => 'role-delete',
            ],
        	[
        		'name' => 'category-list',
        	],
            [
                'name' => 'category-create',
            ],
            [
                'name' => 'category-show',
            ],
            [
                'name' => 'category-edit',
            ],
            [
                'name' => 'category-delete',
            ],
            [
                'name' => 'product-create',
            ],
            [
                'name' => 'product-show',
            ],
            [
                'name' => 'product-edit',
            ],
            [
                'name' => 'product-delete',
            ],
            [
                'name' => 'order-list',
            ],
            [
                'name' => 'order-show',
            ],
            [
                'name' => 'order-create',
            ],
            [
                'name' => 'order-edit',
            ],
            [
                'name' => 'order-delete',
            ],
            [
                'name' => 'product-list',
            ],
            [
                'name' => 'payment-list',
            ],
            [
                'name' => 'payment-show',
            ],
            [
                'name' => 'payment-create',
            ],
            [
                'name' => 'payment-edit',
            ],
            [
                'name' => 'payment-delete',
            ],
        ];

        foreach ($permissions as $key => $value) {
            \Spatie\Permission\Models\Permission::create($value);
        }
    }
}
