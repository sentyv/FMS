<?php
namespace App\Http\Requests\Frontend\Fms;


use Auth ;
use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ViewRequest
 * @package App\Http\Requests\Frontend\SmartFish
 */
class ViewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return $this->user()->can('fms.view');
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}