<?php

namespace ConfrariaWeb\Site\Databases\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data['domains'] = [
            ['domain' => 'localhost', 'site_id' => 1]
        ];

        foreach ($data as $table => $inserts) {
            foreach ($inserts as $insert) {
                DB::table($table)->insert($insert);
            }
        }

    }

}