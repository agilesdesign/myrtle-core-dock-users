<?php

namespace Myrtle\Core\Users\Providers;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Myrtle\Docks\Facades\Docks;
use Myrtle\Permissions\Models\Ability;
use Myrtle\Core\Users\Auth\MyrtleUserProvider;
use Myrtle\Core\Users\Http\Middleware\LogoutDisabledUsers;
use Myrtle\Core\Users\Models\Guest;
use Myrtle\Core\Users\Models\User;
use Pseudo\Contracts\GuestContract;

class UsersServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->bootAuthOverrides();
		$this->bootModelListeners();
        $this->bootRouteMiddleware();
    }

	protected function bootAuthOverrides()
	{
		Auth::provider('myrtle', function ($app, array $config)
		{
			return new MyrtleUserProvider($app['hash'], $config['model']);
		});
	}

	protected function bootModelListeners()
	{
	    //$users = Docks::get('users')->abilitiesItemsDictionary();
//		User::created(function ($user) use ($abilities)
//		{
//			$abilities->each(function ($ability, $key) use ($user)
//			{
//				Ability::create(['name' => 'users.' . $user->id . '.' . $ability]);
//			});
//		});

		User::saving(function ($user)
		{
			$user->timezone = Config::get('app.timezone', date_default_timezone_get());
		});


		User::saved(function ($user)
		{
			$user->searchable();
		});
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerAppBindings();
	}

	protected function registerAppBindings()
	{
		$this->app->bind(GuestContract::class, Guest::class);
	}

    protected function bootRouteMiddleware()
    {
        Route::pushMiddlewareToGroup('web', LogoutDisabledUsers::class);
    }
}
