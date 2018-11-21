<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
        // $this->call(RumahkumuhSeeder::class);
        
        // Eloquent::unguard();
        // $path = public_path('kecamatan/db_gebrak.sql');
        // DB::unprepared(file_get_contents($path));
        // $this->command->info('Table Usulan seeded!');
        
        // $this->call(KelurahanSeeder::class);
        // $this->call(DataSituSeeder::class);
        $this->call(DataIrigasiSeeder::class);
        $this->call(SeederJembatan::class);
        // $this->call(VerifiedDataSeeder::class);
    }
}
