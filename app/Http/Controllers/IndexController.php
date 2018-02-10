<?php

namespace App\Http\Controllers;

/**
 * Class IndexController.
 */
class IndexController extends Controller
{
    /**
     * We only have one route on this controller so we can easily invoke it.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke()
    {
        return view('index');
    }
}
