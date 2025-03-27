<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Explore videos (hanya untuk customer)
            'explores videos',
            'view videos',
            'buy videos',

            // Videos
            'manage videos',
            'create videos',
            'edit videos',
            'delete videos',

            // Reviews
            'manage reviews',
            'create reviews',
            'edit reviews',
            'delete reviews',

            // Wishlist
            'manage wishlists',
            'create wishlists',
            'delete wishlists',

            // User Videos (mengelola daftar video yang dibeli customer)
            'manage user videos',
            'create user videos',
            'delete user videos',

            // User Management
            'manage users',
            'edit users status',
            'delete users',
            'manage user logs',
            'restore users',

            // Transactions (hanya untuk admin & super admin)
            'manage transactions',

            // Sales Data
            'manage sales data',

            // FAQs
            'manage faqs',
            'create faqs',
            'delete faqs',

            // Video & User Logs (Penonaktifan, Soft Delete, dan Restore)
            'manage video logs',
            'restore videos'
        ];

        // Buat permissions jika belum ada
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Role: Customer
        $customer = Role::firstOrCreate(['name' => 'customer']);
        $customer->givePermissionTo([
            'explores videos', 'view videos', 'buy videos',
            'create reviews',
            'create wishlists', 'delete wishlists',
            'manage user videos',
        ]);

        // Role: Admin
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo([
            'manage videos', 'create videos', 'edit videos', 'delete videos',
            'manage reviews', 'edit reviews', 'delete reviews',
            'manage wishlists',
            'manage users', 'edit users status', 'delete users', 'manage user logs', 'restore users',
            'manage sales data',
            'manage faqs', 'create faqs', 'delete faqs',
            'manage video logs', 'restore videos',
        ]);

        // Role: Super Admin
        $superAdmin = Role::firstOrCreate(['name' => 'super admin']);
        $superAdmin->givePermissionTo(
            collect(Permission::all()->pluck('name'))->diff([
                'explores videos', 'view videos', 'buy videos', 'create reviews'
            ])->toArray()
        );
    }
}
