<?php

namespace App\Http\Requests\Tours;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class TourStoreRequest extends BaseRequest
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
            'title_short' => 'required|unique:tours,title_short',
            'cate_id' => 'required|exists:categories,id',
            'status' => 'required|in:1,2',
            'times' => 'required',
            'start_off' => 'required',
            'schedule' => 'required',
            'price' => 'required|numeric',
            'vehicle' => 'required',
            'destination' => 'required',
            'image' => 'required|file|mimes:jpg,jpeg,png|max:10000',
            'image_back' => 'required|file|mimes:jpg,jpeg,png|max:10000',
        ];

        return $rules;
    }

}
