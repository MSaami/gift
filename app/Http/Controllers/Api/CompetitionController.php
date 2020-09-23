<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\AlreadyWinException;
use App\Exceptions\CodeException;
use App\Exceptions\CodeHasFinishedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompetitionRequest;
use App\Models\Code;
use App\Services\Competition\Validator\CodeValidator;
use App\Services\Competition\WinnerDefiner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompetitionController extends BaseController
{
    public function store(CompetitionRequest $request)
    {
        try {

            resolve(WinnerDefiner::class)->handle($request->code, $request->mobile);

            return $this->respondSuccess(__('messages.you won a gift'));

        }catch(CodeException $e){

            return $this->respondClientError($e->getMessage());
        }
    }

}
