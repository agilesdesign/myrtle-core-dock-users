<?php

namespace Myrtle\Core\Users\Models;

use App\Events\UserCreated;
use App\User as LaravelUser;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Myrtle\Permissions\Models\Traits\CanView;
use Myrtle\Permissions\Models\Traits\DefinesAbilities;
use Myrtle\Phones\Models\Traits\Phoneable;
use Myrtle\Addresses\Models\Traits\Addressable;
use Myrtle\Roles\Models\Traits\Roleable;
use Myrtle\Users\Events\UserCreating;
use Myrtle\Users\Events\UserDeleted;
use Myrtle\Users\Events\UserDeleting;
use Myrtle\Users\Events\UserRestored;
use Myrtle\Users\Events\UserRestoring;
use Myrtle\Users\Events\UserSaved;
use Myrtle\Users\Events\UserSaving;
use Myrtle\Users\Events\UserUpdated;
use Myrtle\Users\Events\UserUpdating;
use Myrtle\Users\Models\Traits\UserCascade;
use Myrtle\Users\Models\Traits\UserPermissions;
use Myrtle\Permissions\Models\Traits\Permissionable;
use Myrtle\Users\Models\Traits\UsersFilter;
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
