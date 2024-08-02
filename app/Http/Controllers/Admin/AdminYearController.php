<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dean;
use App\Models\Year;
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
    public function index(Request $request): View
    {
        $years = Year::with(['levels'])
            ->orderByDesc('updated_at')
            ->orderByDesc('onclose')
            ->paginate();

        return view('admin.year.index', [
            'years' => $years,
        ]);
    }

    /**
     * Permet d'afficher plus d'information d'une année académique.
     * @param \App\Models\Year $year
     * @throws \App\Exceptions\YearIsOnClosedException
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Year $year): View
    {
        return view('admin.year.show', [
            'year' => $year,
        ]);
    }

    /**
     * @param \App\Models\Year $year
     * @throws \App\Exceptions\YearIsOnClosedException
     * @return \Illuminate\Http\RedirectResponse
     */
    public function onclose(Year $year): RedirectResponse
    {
        if ($year->onclose) {
            throw new YearIsOnClosedException();
        }

        $year->update(['onclose' => true]);

        $newYear = Year::create([
            'start' => $year->start + 1,
            'end' => $year->end + 2,
        ]);

        event(new CloseYearEvent($newYear));

        return redirect()->route('~year.index');
    }
}
