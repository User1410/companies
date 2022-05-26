<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class UserSeeder extends Seeder
{
    private $roles;

    public function __construct()
    {
        $this->roles = Role::all();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role_id' => $this->roles->firstWhere('name', 'admin')->id
        ]);
    }
}
