<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShopRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:50',
            'image' => 'mimes:jpeg,jpg,png|max:20480',
            'address' => 'required',
            'master_categories' => 'required',
            'status' => 'required',
            'img_url' => 'required'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Only get parameters by file
     *
     * @return array
     */
    public function onlyFields()
    {
        return $this->only([
            'name',
            'image',
            'master_categories',
            'working_time',
            'address',
            'description',
            'status',
            'img_url'
        ]);
    }
}
