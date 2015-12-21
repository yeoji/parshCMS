<?php
namespace Yeoji\ParshCMS\Http\Requests;

class StoreThemeRequest extends Request
{
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
            'title' => 'required|unique:themes',
            'template_file' => 'required|max:1000'
        ];
    }
}