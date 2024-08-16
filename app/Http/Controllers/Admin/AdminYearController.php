<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dean;
use App\Models\Year;
use App\Search\Search;
use App\Query\QueryYear;
use Illuminate\Http\Request;
use App\Events\CloseYearEvent;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\DeanRequest;
use App\Exceptions\YearIsOnClosedException;
use Symfony\Component\HttpFoundation\Response;

class AdminYearController extends Controller
{
    /**
     * Permet d'afficher toutes les doyens
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Search $search): View
    {
        return view('admin.year.index', [
            'years' => $search->years(),
        ]);
    }


    /**
     * @param \App\Models\Year $year
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Year $year): View
    {
        return view('admin.year.show', [
            'year' => $year,
        ]);
    }

    public function closed(Year $year): RedirectResponse
    {
        if ($year->onclose) {
            throw new YearIsOnClosedException();
        }

        $nextYear = QueryYear::nextYear();

        $year->update(['state' => 1]);
        $nextYear->update(['state' => 0]);

        return redirect()
            ->route('~year.index')
            ->with(
                'success',
                "L'année academique {$year->start}-{$year->end} a
                    été cloturée."
            );
    }
}
