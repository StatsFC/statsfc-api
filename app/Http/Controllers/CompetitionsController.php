<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CompetitionRequest;
use App\Http\Controllers\Controller;
use App\Competition;

use Illuminate\Http\Request;

class CompetitionsController extends Controller {

    public function index()
    {
        return Competition::select(['name', 'country', 'key'])
            ->where('online', '=', true)
            ->orderBy('name')
            ->get()
            ->toJson();
    }

}
