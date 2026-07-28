<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('Admin')) {
            return redirect()->route('admin.dashboard');
        }

        if (auth()->user()->hasRole('Manajer Gudang')) {
            return redirect()->route('manager.dashboard');
        }

        if (auth()->user()->hasRole('Staff Gudang')) {
            return redirect()->route('staff.dashboard');
        }

        abort(403);
    }
}