<?php

namespace Interfaces\Http\Site\Controllers;

use Domains\Plans\Actions\GetAllPlansAction;
use Illuminate\Support\Facades\View;
use Infrastructure\Shared\Controller;

class SiteController extends Controller
{
    public function index(GetAllPlansAction $getAllPlansAction)
    {
        $plans = ($getAllPlansAction)(['details']);

        return View::make('site.pages.home.index', compact('plans'));
    }
}
