<?php

namespace Modules\Api\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      properties={
 *          @OA\Property(property="device_id", type="string"),
 *          @OA\Property(property="device_token", type="string"),
 *          @OA\Property(property="device_os", type="string", example="iOS"),
 *          @OA\Property(property="device_name", type="string", example="iPhone 13"),
 *          @OA\Property(property="device_os_version", type="string", example="14.0.2"),
 *          @OA\Property(property="app_version", type="string", example="1.0.1")
 *      }
 * )
 */
class UpdateUserDeviceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'device_id' => 'required',
            'device_token' => 'required',
            'device_os' => 'required|string|in:iOS,Android'
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
            'device_id',
            'device_token',
            'device_os',
            'device_name',
            'device_os_version',
            'app_version'
        ]);
    }
}
