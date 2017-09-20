<?php

namespace App\Http\Requests;

class UpdateBarangRequest extends StoreBarangRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules['title']='required|unique:barangs,title,'.$this->route('barang');
        return $rules;
    }
}
