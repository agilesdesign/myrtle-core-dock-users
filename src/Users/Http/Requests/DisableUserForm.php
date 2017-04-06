<?php

namespace Myrtle\Core\Users\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Myrtle\Core\Users\Models\User;

class DisableUserForm extends FormRequest
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
            //
        ];
    }

    public function update(User $user)
    {
        $user->update(['disabled_at' => Carbon::now() ]);
    }
}
