<?php

use Illuminate\Database\Seeder;
use Myrtle\Core\Users\Models\User;
use Myrtle\Addresses\Models\Country;

class UsersTableSeeder extends Seeder
{
	protected $users = [];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//		$users = collect($this->users);
//
//		$users->each(function($item, $key) {
//
//			$user = User::create(['password' => bcrypt($item['password']), 'timezone' => 'America/New_York']);
//
//			collect($item['emails'])->each(function($email, $key) use ($user) {
//				$user->emails()->create($email);
//			});
//
//			$user->name()->create($item['name']);
//
//			if ($user->id == 1)
//			{
//				$user->roles()->attach(1);
//			}
//		});

//		factory(\App\Models\User::class, 50)->create()->each(function($u) {
//			$u->name()->save(factory(\App\Models\UserName::class)->make());
//			$u->emails()->save(factory(\App\Models\EmailUser::class)->make());
//		});
    }
}
