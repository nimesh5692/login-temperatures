<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLoginData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $cities = config('cities.cities');
            $userMetaData = UserLoginData::where('user_id', Auth::user()->id)->orderBy('created_at')->get();
            return response()->json(compact('cities', 'userMetaData'), 200);
        }

        return view('home');
    }
}
