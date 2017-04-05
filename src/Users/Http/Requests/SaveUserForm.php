<?php

namespace Myrtle\Core\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Myrtle\Users\Models\User;

class SaveUserForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
		return [
			'password' => ['required', 'confirmed'],
			'name.first' => 'required',
			'name.last' => 'required',
			'biograph.gender_id' => ['sometimes', 'exists:genders,id'],
			'biograph.ethnicity_id' => ['sometimes', 'exists:ethnicities,id'],
			'biograph.maritalstatus_id' => ['sometimes', 'exists:maritalstatuses,id'],
			'biograph.religion_id' => ['sometimes', 'exists:religions,id'],
		];
    }

    public function save(User $user = null)
	{
		$method = debug_backtrace()[1]['function'];

		return call_user_func_array([$this, $method], func_get_args());
	}

	public function store()
	{
		$user = User::create(['password' => bcrypt($this->password)]);

		$user->name()->create(
			collect($this->name)->reject(function ($item, $key)
			{
				return empty($item);
			})->toArray()
		);

		collect($this->emails)->each(function ($item, $key) use ($user)
		{
			$user->emails()->create($item);
		});

		$user->biograph()->create(
			collect($this->biograph)->reject(function ($item, $key) use ($user)
			{
				return empty($item);
			})->toArray()
		);

		return $user;
	}

	public function update(User $user)
	{
		if ($password = $this->password)
		{
			$user->update(
				['password' => bcrypt($password)]
			);
		}

		// so form builder doesn't have the ability for a null placeholder
		// in it's select input, it submits an empty string instead
		// we need to account for that since all biograph stores
		// stores integers

		collect($this->biograph)->each(function ($item, $key) use ($user)
		{
			$item = ! empty($item) ? $item : null;

			$user->biograph->fill([$key => $item]);
		});

		$user->biograph->save();

		collect($this->name)->each(function ($item, $key) use ($user)
		{
			$item = ! empty($item) ? $item : null;

			$user->name->fill([$key => $item]);
		});

		$user->name->save();

		return $user;
	}

	public function messages()
    {
        return [
            'name.first.required' => 'First name is required',
            'name.last.required' => 'Last name is required'
        ];
    }
}
