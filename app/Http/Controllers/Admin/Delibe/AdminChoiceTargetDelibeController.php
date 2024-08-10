<?php


namespace App\Http\Controllers\Admin\Delibe;


use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class AdminChoiceTargetDelibeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        return view('admin.delibe.index');
    }
}
