<?php

namespace Interfaces\Http\Site\Controllers;

use Domains\Plans\Actions\GetAllPlansAction;
use Infrastructure\Shared\Controller;

class SiteController extends Controller
{
    public function index(GetAllPlansAction $getAllPlansAction)
    {
        $plans = $getAllPlansAction(with: ['details']);

        return view('site.pages.home.index', compact('plans'));
    }

    public function choosePlan(string $planUrl)
    {
        return to_route('register', $planUrl);
    }
}
