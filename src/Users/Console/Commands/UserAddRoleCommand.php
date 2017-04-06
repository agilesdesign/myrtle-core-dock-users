<?php

namespace Myrtle\Core\Users\Console\Commands;

use Myrtle\Core\Roles\Models\Role;
use Illuminate\Console\Command;
use Myrtle\Core\Users\Models\UserEmail;

class UserAddRoleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:role:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add user to a Role';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = UserEmail::all()->pluck('address')->toArray();

        $emailChoice = $this->anticipate('Select a user', $users, null);

        $user = UserEmail::where('address', $emailChoice)->first()->user;

        $roles = Role::assignable()->whereNotIn('id', $user->roles->pluck('id')->toArray())->get();

        $roleChoice = $this->choice('Select a role', $roles->pluck('name', 'id')->toArray(), null);

        $role = $roles->filter(function($role) use ($roleChoice) {
           return $role->name === $roleChoice;
        })->first();

        $user->roles()->attach($role);
    }
}
