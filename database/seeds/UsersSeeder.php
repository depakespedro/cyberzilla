<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class, 100)->create()->each(function (\App\User $user) {
            $user->profile()->save(factory(App\Profile::class)->make());

            for ($i = 0; $i <= random_int(1, 5); $i++) {
                $user->contacts()->save(factory(App\Contact::class)->make());
            }
        });
    }
}
