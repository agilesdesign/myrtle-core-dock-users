<?php

namespace Myrtle\Core\Docks;

use Myrtle\Core\Users\Console\Commands\CreateUserCommand;
use Myrtle\Core\Users\Console\Commands\UserAddRoleCommand;
use Myrtle\Core\Users\Models\User;
use Myrtle\Core\Users\Policies\UserPolicy;
use Myrtle\Core\Users\Policies\RegistrationPolicy;
use Myrtle\Core\Users\Policies\AuthenticationPolicy;
use Myrtle\Core\Users\Providers\UsersServiceProvider;
use Illuminate\Auth\Access\AuthorizationException;
use Myrtle\Core\Users\Handlers\AuthorizationExceptionAbettor;

class UsersDock extends Dock
{
    /**
     * Console Commands
     *
     * @var array
     */
    public $commands = [
        CreateUserCommand::class,
        UserAddRoleCommand::class,
    ];

    /**
     * Description for Dock
     *
     * @var string
     */
    public $description ='User management system';

    /**
     * Exceptum mappings
     *
     * @var array
     */
    public $exceptumMap = [
        AuthorizationException::class => AuthorizationExceptionAbettor::class
    ];

    /**
     * Explicit Gate definitions
     *
     * @var array
     */
    public $gateDefinitions = [
        'users.access-admin' => UserPolicy::class.'@accessAdmin',
        'users.admin'        => UserPolicy::class.'@admin',
        'login'              => AuthenticationPolicy::class.'@login',
        'logout'             => AuthenticationPolicy::class.'@logout',
        'register'           => RegistrationPolicy::class.'@register',
    ];

    /**
     * Policy mappings
     *
     * @var array
     */
    public $policies = [
        User::class                 => UserPolicy::class,
        UserPolicy::class           => UserPolicy::class,
        RegistrationPolicy::class   => RegistrationPolicy::class,
        AuthenticationPolicy::class => AuthenticationPolicy::class
    ];

    /**
     * List of providers to be registered
     *
     * @var array
     */
    public $providers = [
        UsersServiceProvider::class,
    ];

    /**
     * List of config file paths to be loaded
     *
     * @return array
     */
    public function configPaths()
    {
        return [
            'docks.' . self::class => dirname(__DIR__, 3) . '/config/docks/users.php',
            'abilities' => dirname(__DIR__, 3) . '/config/abilities.php',
        ];
    }

    /**
     * List of migration file paths to be loaded
     *
     * @return array
     */
    public function migrationPaths()
    {
        return [
            dirname(__DIR__, 3) . '/database/migrations',
        ];
    }

    /**
     * List of routes file paths to be loaded
     *
     * @return array
     */
    public function routes()
    {
        return [
            'admin' => dirname(__DIR__, 3) . '/routes/admin.php',
            'front' => dirname(__DIR__, 3) . '/routes/front.php',
        ];
    }
}
