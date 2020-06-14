<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeprecatedController extends ApiController
{
    public function index(Request $request)
    {
        return $this->respondUnavailable('/v1 is now deprecated. Please upgrade to /v2');
    }
}
