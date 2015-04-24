<?php namespace App\Http\Controllers;

use App\Competition;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class CompetitionsController extends Controller {

    public function index()
    {
        $competitions = Competition::select('competitionNew.id', 'competitionNew.name', 'region.name AS region')
            ->online()
            ->leftJoin('region', 'competitionNew.region_id', '=', 'region.id')
            ->orderBy('competitionNew.name')
            ->get();

        return response($competitions->toJson())->header('Content-Type', 'application/json');
    }

}
