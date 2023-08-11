<?php

namespace App\Http\Controllers\Backend;

use App\Domains\Auth\Models\User;
use Carbon\Carbon;

/**
 * Class DashboardController.
 */
class DashboardController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $countData = User::count();

        $typeCol = User::selectRaw('type as x, COUNT(*) as y')
        ->orderBy("y")
        ->groupBy('x')
        ->get();

        $typeData[] = [];
        foreach ($typeCol as $value) {
            $typeData[0][] = $value->x;
        }
        foreach ($typeCol as $value) {
            $typeData[] = [$value->x, $value->y];
        }


        $dateCol = User::selectRaw('DATE(created_at) as x, COUNT(*) as y')
        ->groupBy('x')
        ->get();
        $dateData[] = ['Date','Users Count'];
        foreach ($dateCol as $value) {
            $dateData[] = [$value->x, $value->y];
        }
        return view('backend.dashboard', compact('countData', 'dateData', 'typeData'));
    }
}
