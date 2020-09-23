<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CodeRequest;
use App\Http\Requests\CodeUpdateRequest;
use App\Http\Resources\CodeCollection;
use App\Http\Resources\CodeResource;
use App\Models\Code;
use Illuminate\Http\Request;

class CodeController extends BaseController
{

    public function index(Request $request)
    {

        $codes = Code::filter($request->all());

        return $this->respond(new CodeCollection($codes));
    }

    public function store(CodeRequest $request)
    {
        try{
            $code = Code::create($request->only(['code', 'remaining', 'is_active']));

            return $this->respondCreated();

        }catch(\Exception $e){

            return $this->respondInternalError();

        }
    }

    public function show(Code $code)
    {
        return $this->respond(new CodeResource($code));
    }

    public function update(CodeUpdateRequest $request, Code $code)
    {
        try{
            $code->update($request->only(['code', 'remaining', 'is_active']));

            return $this->respondSuccess();

        }catch(\Exception $e){

            return $this->respondInternalError();
        }

    }
}
