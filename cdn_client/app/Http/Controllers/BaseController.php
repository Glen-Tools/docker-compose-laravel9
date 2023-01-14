<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\ParameterException;
use Illuminate\Http\Response;

class BaseController extends Controller
{
    public function show(Request $request,$id)
    {
        if (!is_numeric($id)) {
            throw new ParameterException(trans('error.param_not_number', ['param' => $id]), Response::HTTP_BAD_REQUEST);
        }
    }
    public function update(Request $request,$id)
    {
        if (!is_numeric($id)) {
            throw new ParameterException(trans('error.param_not_number', ['param' => $id]), Response::HTTP_BAD_REQUEST);
        }
    }
    public function destroy(Request $request,$id)
    {
        if (!is_numeric($id)) {
            throw new ParameterException(trans('error.param_not_number', ['param' => $id]), Response::HTTP_BAD_REQUEST);
        }
    }
}
