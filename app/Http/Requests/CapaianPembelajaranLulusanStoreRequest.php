<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CapaianPembelajaranLulusanStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole('koordinator program studi');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'domain' => 'bail|required',
            'deskripsi' => 'bail|required'
        ];
    }

    public function message()
    {
        return [
            'domain.required' => 'Domain harus dipilih',

            'deskripsi.required' => 'Deskripsi harus diisi.'
        ];
    }
}
