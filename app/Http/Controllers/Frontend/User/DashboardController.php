<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $words = auth()->user()->words()->get();//Word::where('status', 1)
        return view('frontend.user.dashboard',[
            'words' => $words,
        ]);
    }
}
