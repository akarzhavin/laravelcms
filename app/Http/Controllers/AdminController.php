<?php

namespace App\Http\Controllers;

use App\Http\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use View;

/**
 * Class AdminController
 * Controller for admin area.
 *
 * @category AppControllers
 */
class AdminController extends Controller
{

    /**
     * Display admin dashboard.
     *
     * @return View
     */
    public function welcome()
    {
        return view('admin_them.landing');
    }

    /**
     * @return View
     */
    public function settings()
    {
        $settings = Setting::all()->toArray();

        return view('admin/settings', compact('settings'));
    }


}
