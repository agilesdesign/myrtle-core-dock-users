<?php

namespace Myrtle\Core\Users\Http\Requests;

class StoreUserForm extends SaveUserForm
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return array_merge(parent::rules(), $this->additionalRules());
	}

	public function additionalRules()
	{
		return [
			'emails.*.address' => ['required', 'email', 'unique:user_emails,address'],
		];
	}

	public function messages()
    {
        return array_merge(parent::messages(), $this->additionalMessages());
    }

    public function additionalMessages()
    {
        return [
            'emails.*.address.required' => 'A valid email address is required',
            'emails.*.address.email' => 'A valid email address is required',
            'password.required' => 'A password is required'
        ];
    }
}
