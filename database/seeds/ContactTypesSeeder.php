<?php

use Illuminate\Database\Seeder;

class ContactTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contacts_types')->insert([
            [
                'id' => 1,
                'code' => 'phone',
                'title' => 'Телефон',
            ],
            [
                'id' => 2,
                'code' => 'vk',
                'title' => 'ВК',
            ],
            [
                'id' => 3,
                'code' => 'fb',
                'title' => 'Фейсбук',
            ],
        ]);
    }
}
