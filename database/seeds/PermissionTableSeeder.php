<?php


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


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
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'bank-list',
           'bank-create',
           'bank-edit',
           'bank-delete',
           'client-list',
           'client-create',
           'client-edit',
           'client-delete',
           'transaction-list',
           'transaction-create',
           'transaction-edit',
           'transaction-delete',
           'workshop-list',
           'workshop-create',
           'workshop-edit',
           'workshop-delete',
           'product-list',
           'product-create',
           'product-edit',
           'product-delete',
           'expense-list',
           'expense-create',
           'expense-edit',
           'expense-delete',
           'supplier-list',
           'supplier-create',
           'supplier-edit',
           'supplier-delete',
           'incomes-list',
           'incomes-create',
           'incomes-edit',
           'incomes-delete',
           'summary-list',
           'outstanding-list',
           'outstanding-create',
           'outstanding-edit',
           'outstanding-delete',
           'payment-list',
           'payment-create',
           'payment-edit',
           'payment-delete',
           'users-list',
           'users-create',
           'users-edit',
           'users-delete',
        ];

        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
