<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class MahasiswaRequest extends FormRequest
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
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'nim' => 'numeric|max:9',
            'nama' => 'alpha|required',
            'jenis_kelamin' => 'required',
            'email' => 'email:rfc,dns|required',
            'tahun_angkatan' => 'required',
            'kelas' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nim.numeric' => 'NIM harus berupa angka',
            'nim.max' => 'NIM maksimal 9 karakter',
            'nama.alpha' => 'Nama harus berupa huruf',
            'nama.required' => 'Nama harus diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin harus diisi',
            'email.email' => 'Email tidak valid',
            'email.required' => 'Email harus diisi',
            'tahun_angkatan.required' => 'Tahun Angkatan harus diisi',
            'kelas.required' => 'Kelas harus diisi'
        ];
    }
}
