<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\ParameterException;
use Hamcrest\Type\IsNumeric;

class BaseController extends Controller
{
    public function show(Request $request,$id)
    {
        if (!is_numeric($id)) {
            throw new ParameterException(trans('error.param_not_number', ['param' => $id]));
        }
    }
    public function update(Request $request,$id)
    {
        if (!is_numeric($id)) {
            throw new ParameterException(trans('error.param_not_number', ['param' => $id]));
        }
    }
    public function destroy(Request $request,$id)
    {
        if (!is_numeric($id)) {
            throw new ParameterException(trans('error.param_not_number', ['param' => $id]));
        }
    }
}
