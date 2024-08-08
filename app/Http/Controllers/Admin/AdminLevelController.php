<?php

namespace App\Http\Controllers\Admin;

use App\Models\Level;
use App\Search\Filter;
use App\Search\Search;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\LevelRequest;

class AdminLevelController extends Controller
{
    /**
     * Permet d'afficher toutes les promotions
     * @param \App\Search\Search $search
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Filter $filter): View
    {
        return view('admin.level.index', [
            'levels' => $filter->levels(),
        ]);
    }


    /**
     * Permet d'afficher plus d'information sur une promotion
     *
     * @param \App\Models\Level $level
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Level $level): View
    {
        return view('admin.level.show', [
            'level' => $level
        ]);
    }
}
