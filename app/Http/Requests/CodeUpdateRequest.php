<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class CodeUpdateRequest extends CodeRequest
{

    public function rules()
    {
        return array_merge(parent::rules(), [
            'code' => ['required', 'string', 'regex:/^[A-Za-z0-9_]+$/', Rule::unique('codes')->ignore($this->id)]
        ]);
    }
}
