<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


/**
 * Class PartiallyUpdateRequest
 * @package App\Http\Requests
 */
class CreateRequest extends FormRequest
{

   
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'virus_composition' => 'required|string',
            'blood_composition' => 'required|array',
            'blood_composition.*' => 'required_with:blood_composition|string',
        ];
    }


}
