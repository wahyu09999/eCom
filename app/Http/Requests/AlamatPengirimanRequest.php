<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlamatPengirimanRequest extends FormRequest
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
            'nama_penerima' => 'required',
            'no_tlp' => 'required',
            'alamat' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
            'kodepos' => 'required|min:5|numeric',
        ];
    }

    public function messages()
    {
        return [
            'nama_penerima.required' => 'Nama penerima harus diisi',
            'no_tlp.required' => 'Nomor HP harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'kelurahan.required' => 'Kelurahan/Desa harus diisi',
            'kecamatan.required' => 'Kecamatan harus diisi',
            'kota.required' => 'Kabupaten/Kota harus diisi',
            'provinsi.required' => 'Provinsi harus diisi',
            'kodepos.required' => 'Kodepos harus diisi',
            'kodepos.numeric' => 'Kodepos harus berupa angka',
            'kodepos.min' => 'Kodepos minimal 5 karakter',
        ];
    }
}