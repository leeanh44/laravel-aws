<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'image' => 'required|mimes:jpeg,jpg,png|max:20480',
            'order' => 'required',
            'status' => 'required'
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
            'order',
            'status'
        ]);
    }
}
