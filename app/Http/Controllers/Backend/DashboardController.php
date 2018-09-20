<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;


class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('backend.pages.dashboard.index');
    }
}
