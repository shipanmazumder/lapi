<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationFormRequest extends FormRequest
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
         switch($this->method())
            {
                case 'GET':
                case 'DELETE':
                {
                    return [];
                }
                case 'POST':
                {
                     return [
                        'name' => 'required|string',
                        'email' => 'required|email|unique:users',
                        'role_id' => 'required|string',
                        'password' => 'required|string|min:4|max:10'
                    ];
                }
                case 'PUT':
                case 'PATCH':
                {
                   return [
                        'name' => ['required', 'string', 'max:255'],
                         'email' => ['required', 'string', 'email', 'max:255', 'unique:users,id,'.$this->get("user")],
                         'role_id' => ['required', 'string'],
                         'password' => ['sometimes'],
                    ];
                }
                default:break;
            }
    }
}
