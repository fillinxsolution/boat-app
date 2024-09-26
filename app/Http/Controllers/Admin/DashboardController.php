<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class DashboardController extends BaseController
{

    public function __construct() {
//        $this->middleware('permission:dashboard-view', ['only' => ['index']]);

    }

    /**
     * Get a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(){

        $stats['suppliers'] =  User::has('supplier')->with('supplier')->where('is_admin',0)->count();

//        $stats['captains'] =  User::has('captains')->with('captains')->where('is_admin',0)->count();

        $stats['users'] =  User::where('is_admin',1)->count();

        return view('pages.dashboard.index',compact('stats'));
    }
}
