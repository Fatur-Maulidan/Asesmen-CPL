<?php

namespace App\Http\Requests;

use App\Models\Master_07_MataKuliah;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class MataKuliahRequest extends FormRequest
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
        $id = $this->route('mata_kuliah');

        return [
            'kode' => [
                'bail', 'required',
                Rule::unique('07_MASTER_mata_kuliah', 'kode')->ignore($id),
            ],
            'nama' => 'bail|required',
            'deskripsi' => 'bail|required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'kode.required' => 'Kode mata kuliah perlu diisi.',
            'kode.unique' => 'Kode mata kuliah sudah terdaftar.',

            'nama.required' => 'Nama mata kuliah perlu diisi.',

            'deskripsi.required' => 'Deskripsi mata kuliah perlu diisi.',
        ];
    }
}
