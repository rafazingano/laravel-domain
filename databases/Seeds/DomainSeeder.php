<?php

namespace ConfrariaWeb\Domain\Databases\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DomainSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data['domains'] = [
            ['domain' => 'localhost', 'user_id' => 1]
        ];

        foreach ($data as $table => $inserts) {
            foreach ($inserts as $insert) {
                //DB::table($table)->insert($insert);
            }
        }

    }

}