<?php

namespace Myrtle\Core\Users\Models;

use App\Events\UserCreated;
use App\User as LaravelUser;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Myrtle\Core\Permissions\Models\Traits\CanView;
use Myrtle\Core\Permissions\Models\Traits\DefinesAbilities;
use Myrtle\Core\Phones\Models\Traits\Phoneable;
use Myrtle\Core\Addresses\Models\Traits\Addressable;
use Myrtle\Core\Roles\Models\Traits\Roleable;
use Myrtle\Core\Users\Events\UserCreating;
use Myrtle\Core\Users\Events\UserDeleted;
use Myrtle\Core\Users\Events\UserDeleting;
use Myrtle\Core\Users\Events\UserRestored;
use Myrtle\Core\Users\Events\UserRestoring;
use Myrtle\Core\Users\Events\UserSaved;
use Myrtle\Core\Users\Events\UserSaving;
use Myrtle\Core\Users\Events\UserUpdated;
use Myrtle\Core\Users\Events\UserUpdating;
use Myrtle\Core\Users\Models\Traits\UserCascade;
use Myrtle\Core\Users\Models\Traits\UserPermissions;
use Myrtle\Core\Permissions\Models\Traits\Permissionable;
use Myrtle\Core\Users\Models\Traits\UsersFilter;
use Persons\Models\Traits\IsPerson;
use Repertoire\Models\Constants\EloquentDates;
use Repertoire\Models\Traits\CanBeSearched;
use Repertoire\Models\Traits\CreatedBy;
use Repertoire\Models\Traits\DeletedBy;
use Repertoire\Models\Traits\UpdatedBy;

class User extends LaravelUser
{
    use Addressable, CanBeSearched, CanView, CreatedBy,
        DefinesAbilities, DeletedBy,
        IsPerson,
        Notifiable,
        Permissionable, UserPermissions,
        Phoneable,
        Roleable,
        Searchable, SoftDeletes,
        UpdatedBy, UserCascade, UsersFilter;

    protected $fillable = ['password', EloquentDates::DISABLED_AT];

	protected $dates = [Model::CREATED_AT, Model::UPDATED_AT, EloquentDates::DISABLED_AT, EloquentDates::DELETED_AT];

    protected $hidden = ['password', 'remember_token'];

	protected $with = ['emails', 'name', 'roles'];

	protected $events = [
		'creating' => UserCreating::class,
		'created' => UserCreated::class,
		'deleting' => UserDeleting::class,
		'deleted' => UserDeleted::class,
		'restoring' => UserRestoring::class,
		'restored' => UserRestored::class,
		'saving' => UserSaving::class,
		'saved' => UserSaved::class,
		'updating' => UserUpdating::class,
		'updated' => UserUpdated::class,
	];

	public function emails()
	{
		return $this->hasMany(UserEmail::class);
	}

	public function getTimezoneAttribute($value)
	{
		return $value;
	}

	public function toSearchableArray()
	{
		return [
			'id' => $this->id,
			'name' => $this->name,
			'emails' => $this->emails,
		];
	}
}
