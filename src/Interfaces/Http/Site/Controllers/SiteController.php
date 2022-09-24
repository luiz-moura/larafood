<?php

namespace Interfaces\Http\Site\Controllers;

use Domains\Plans\Actions\FindPlanByUrlAction;
use Domains\Plans\Actions\GetAllPlansAction;
use Infrastructure\Shared\Controller;

class SiteController extends Controller
{
    public function index(GetAllPlansAction $getAllPlansAction)
    {
        $plans = $getAllPlansAction(with: ['details']);

        return view('site.pages.home.index', compact('plans'));
    }

    public function choosePlan(
        string $planUrl,
        FindPlanByUrlAction $findPlanByUrlAction
    ) {
        $planData = $findPlanByUrlAction($planUrl);

        session()->put('plan', $planData);

        return to_route('register');
    }
}
