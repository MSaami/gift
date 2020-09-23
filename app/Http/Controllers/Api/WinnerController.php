<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompetitionRequest;
use App\Http\Resources\WinnerCollection;
use App\Models\Code;
use App\Models\Winner;
use Illuminate\Http\Request;

class WinnerController extends BaseController
{
    public function index(Request $request)
    {
        $winners = Winner::with('code')->filter($request->all());

        return $this->respond(new WinnerCollection($winners));
    }

    public function hasWon(CompetitionRequest $request)
    {
        $code = Code::firstWhere('code', $request->code);

        $winner = $code->filterWinnerBy($request->mobile);

        return $this->respond([
            'result' => $winner->isNotEmpty(),
            'winner' => $winner
        ]);
    }
}
