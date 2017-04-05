<?php

namespace Myrtle\Core\Users\Http\Requests;

use Flasher\Support\Notifier;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class AuthenticationRequest extends FormRequest
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
            'email' => ['required', 'email'],
            'password' => 'required'
        ];
    }

    public function login()
    {
        if( ! Auth::attempt($this->only('email', 'password'), $this->has('remember')))
        {
            flasher()->alert(Lang::get('auth.failed'), 'danger');

            return redirect()->back()->withInput($this->only('email', 'remember'));
        }

        flasher()->alert('Welcome back! You\'re now logged in', Notifier::SUCCESS);

        if(Auth::user()->can('system.access.admin'))
        {
            return redirect(route('admin.frontpage'));
        }

        return redirect(route('landing'));
    }
}
