<?php

namespace App\Http\Requests\Frontend\Fms;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFileMovementRequest extends FormRequest
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
          'start_date'  => ['required','date','before_or_equal:tomorrow'],
          'return_date' => ['nullable','date','after:start_date'],
          'user'        => ['required','integer','min:1','exists:pgsql.app.users,id']
        ];
    }
}
