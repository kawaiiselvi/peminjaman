<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreBarangRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'required|unique:barangs,title',
            'amount'=>'numeric',
            'stock'=>'numeric',
            'penanggung_id'=>'required|exists:penanggungs,id',
            'cover'=>'image|max:2048'
        ];
    }
}
