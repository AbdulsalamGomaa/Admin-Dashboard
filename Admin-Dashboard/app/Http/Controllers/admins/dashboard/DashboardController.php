<?php

namespace App\Http\Controllers\admins\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard() {

        return view('admins.dashboard.dashboard');
    }
}
