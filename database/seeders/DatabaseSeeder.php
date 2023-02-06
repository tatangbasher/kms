<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /** Roles */
        DB::table('roles')->insert([
            'name' => 'admin',
            'description' => 'Admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('roles')->insert([
            'name' => 'counselor',
            'description' => 'Counseling Teacher',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        $this->call([UsersTableSeeder::class]);
    }
}
