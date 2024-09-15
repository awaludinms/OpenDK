<?php

namespace App\Http\Requests\Lembaga;

use Illuminate\Foundation\Http\FormRequest;

class StoreLembagaRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nama_lembaga' => 'required',
            'kode_lembaga' => 'required|unique:das_lembaga,kode_lembaga',
            'nomor_sk_pendirian_lembaga' => 'required',
            'das_kategori_lembaga_id' => 'required',
            'penduduk_id' => 'required',
            'deskripsi_lembaga' => 'required',
            'logo_lembaga' => 'nullable',
        ];
    }
}
