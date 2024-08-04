<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dean;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\DeanRequest;

class AdminDelibeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request): View
    {
        return view('admin.delibe.index', []);
    }

    public function push(Request $request): RedirectResponse
    {
        return redirect()->route('~delibe.index', [
            ...$request->query->all(),
        ])->with('success', 'délibération effectuée');
    }
}
