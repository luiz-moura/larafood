<?php

namespace Interfaces\Http\Site\Controllers;

use Domains\Plans\Actions\FindPlanByUrlAction;
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

    public function choosePlan(string $planUrl, FindPlanByUrlAction $findPlanByUrlAction)
    {
        $plan = ($findPlanByUrlAction)($planUrl);

        session()->put('plan', $plan);

        return redirect()->route('register');
    }
}
