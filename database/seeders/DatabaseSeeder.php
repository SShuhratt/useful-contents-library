<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Author;
use App\Models\Category;
use App\Models\Content;
use App\Models\Genre;
use Illuminate\Support\Facades\Hash;
use MoonShine\Laravel\Models\MoonshineUser;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['superadmin', 'admin', 'user'];
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        }

        Author::factory(10)->create();
        Category::factory(10)->create();
        Content::factory(10)->create();
        Genre::factory(10)->create();

        $superadmin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('superadmin123'), // 🔐 Default password
        ]);
        $superadmin->assignRole('superadmin');

        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'), // 🔐 Default password
        ]);
        $admin->assignRole('admin');

        User::factory(10)->create()->each(function ($user) {
            $user->assignRole('user');
        });
        MoonShineUser::create([
            'name' => 'shuhrat',
            'email' => 'shuhrat@gmail.com',
            'password' => Hash::make('shuhrat1'),
        ]);
    }
}
