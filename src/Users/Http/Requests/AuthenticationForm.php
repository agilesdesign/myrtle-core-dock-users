<?php

namespace Myrtle\Core\Users\Http\Requests;

use Flasher\Support\Notifier;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Myrtle\Core\Users\Auth\SocialiteManager;

class AuthenticationForm extends FormRequest
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

    public function process()
    {
        $method = debug_backtrace()[1]['function'];

        return call_user_func_array([$this, $method], func_get_args());
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

    public function authenticate()
    {
        if( ! Auth::attempt(request()->only('email', 'password'), request()->has('remember')))
        {
            flasher()->alert(Lang::get('auth.failed'), 'danger');

            return redirect()->back()->withInput($this->only('email', 'remember'));
        }

        flasher()->alert('Welcome back! You\'re now logged in', Notifier::SUCCESS);

        return redirect()->intended();
    }
}
