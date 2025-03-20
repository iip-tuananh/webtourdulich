<?php

namespace App\Http\Requests\Tours;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class TourUpdateRequest extends BaseRequest
{
    /**
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
        $rules = [
            'title_short' => 'required|unique:tours,title_short,'.$this->route('id').",id",
            'cate_id' => 'required|exists:categories,id',
            'status' => 'required|in:1,2',
            'times' => 'required',
            'start_off' => 'required',
            'schedule' => 'required',
            'price' => 'required|numeric',
            'vehicle' => 'required',
            'destination' => 'required',
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:10000',
            'image_back' => 'nullable|file|mimes:jpg,jpeg,png|max:10000',
        ];

        return $rules;
    }

}
