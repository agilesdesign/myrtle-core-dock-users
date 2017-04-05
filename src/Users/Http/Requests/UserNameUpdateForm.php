<?php

namespace Myrtle\Core\Users\Http\Requests;

use Persons\Http\Requests\PersonNameUpdateForm;

class UserNameUpdateForm extends PersonNameUpdateForm
{
	protected $routeParameterKey = 'user';
}
