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

            $user->contacts()->save(
                new \App\Contact([
                    'contact_type_id' => 1,
                    'info' => \Illuminate\Support\Str::random(16)
                ])
            );
            $user->contacts()->save(
                new \App\Contact([
                    'contact_type_id' => 2,
                    'info' => \Illuminate\Support\Str::random(16)]
                )
            );
            $user->contacts()->save(
                new \App\Contact([
                    'contact_type_id' => 3,
                    'info' => \Illuminate\Support\Str::random(16)]
                )
            );

            $user->assignRole('user');
        });

        $user = \App\User::find(1);
        $user->assignRole('admin');
    }
}
