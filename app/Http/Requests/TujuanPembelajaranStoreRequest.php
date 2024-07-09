<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TujuanPembelajaranStoreRequest extends FormRequest
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
            'deskripsi' => 'bail|required|string',
            'bobot' => 'bail|required|numeric',
        ];
    }

    public function message()
    {
        return [
            'deskripsi.required' => 'Deskripsi harus diisi',
            'bobot.required' => 'Bobot harus diisi',
        ];
    }
}
