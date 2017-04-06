<?php

namespace Myrtle\Core\Users\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Myrtle\Core\Users\Models\Traits\UserMustHaveOneEmail;

class UserEmail extends Model
{
	use SoftDeletes, UserMustHaveOneEmail;

    /**
     * The name of the "deleted at" column.
     *
     * @var string
     */
    const DELETED_AT = 'deleted_at';

    protected $dates = [Model::CREATED_AT, Model::UPDATED_AT, self::DELETED_AT];

	protected $fillable = ['address'];

	protected $touches = ['user'];

    public function user()
	{
		return $this->belongsTo(User::class);
	}
}
