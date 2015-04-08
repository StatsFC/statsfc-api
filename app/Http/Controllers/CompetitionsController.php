<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CompetitionRequest;
use App\Http\Controllers\Controller;
use App\Competition;

use Illuminate\Http\Request;

class CompetitionsController extends Controller {

    public function index()
    {
        $competitions = Competition::select(['name', 'country', 'key'])->online()->orderBy('name')->get();

        return response($competitions->toJson())->header('Content-Type', 'application/json');
    }

}
