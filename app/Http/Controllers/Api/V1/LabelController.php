<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LabelRequest;
use App\Models\Label;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LabelController extends Controller
{
    public function index()
    {
        return auth()->user()->labels;
    }

    public function store(LabelRequest $request)
    {
        return auth()->user()->labels()->create($request->validated());
    }

    public function update(LabelRequest $request,Label $label)
    {
        return $label->update($request->validated());
    }

    public function destroy(Label $label)
    {
        $label->delete();
        return response('',Response::HTTP_NO_CONTENT);
    }

}
