<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdukRequest extends FormRequest
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
            'kategori_id' => 'required',
            'nama' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|mimes:png,jpg,jpeg|max:5012',
        ];
    }

    public function messages()
    {
        return [
            'kategori_id.required' => 'Kategori harus diisi',
            'nama.required' => 'Nama produk harus diisi',
            'harga.required' => 'Harga produk harus diisi',
            'stok.required' => 'Stok produk harus diisi',
            'deskripsi.required' => 'Deskripsi produk harus diisi',
            'gambar.required' => 'Gambar produk harus diisi',
            'gambar.max' => 'Ukuran gambar produk maksimal 5MB',
            'gambar.mimes' => 'Gambar produk harus berupa JPG | PNG | JPEG',
        ];
    }
}