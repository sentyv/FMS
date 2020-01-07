<?php

namespace App\Http\Requests\Frontend\Fms;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFileRequest extends FormRequest
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
          'file_reference_name' => ['required','max:400'],
          'file_subject_title' => ['required','max:400'],
          'file_author_name' => ['required','max:400'],
          'file_published_date' => ['required','date','before:tomorrow'],
          'file_received_date' => ['required','date','after:file_published_date'],
          'file_publisher_id' => ['required'],
          'file_reference_id' => ['required','integer','min:1','exists:pgsql.fms.reference,id'],
        ];
    }
}
