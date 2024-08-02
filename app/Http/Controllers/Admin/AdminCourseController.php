<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Helpers\SearchDefine;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\CourseRequest;
use App\Http\Requests\Admin\StudentRequest;

class AdminCourseController extends Controller
{

    /**
     * Permet d'afficher toutes les cours
     * @param \App\Helpers\SearchDefine $search
     * @return \Illuminate\Contracts\View\View
     */
    public function index(SearchDefine $search): View
    {
        return view('admin.course.index', [
            'courses' => $search->courses(),
        ]);
    }

    /**
     * Permet d'afficher un formulaire de création d'un cours
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        return view('admin.course.create', [
            'course' => new Course(),
        ]);
    }


    /**
     * Permet de créer un cours
     *
     * @param \App\Http\Requests\Admin\CourseRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CourseRequest $request): RedirectResponse
    {
        $course = Course::create([
            'name' => $request->validated('name'),
            'credits' => $request->validated('credits'),
            'description' => $request->validated('description'),
            'professor_id' => $request->validated('professor_id'),
            'semester_id' => $request->validated('semester_id'),
            'group_id' => $request->validated('group_id'),
        ]);

        $course->levels()->sync($request->validated('levels'));
        $course->students()->sync($request->validated('students'));

        return redirect()->route('~course.index')
            ->with('success', 'cours ajouté');
    }


    /**
     * Permet d'afficher plus d'information sur un cours
     *
     * @param \App\Models\Course $course
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Course $course): View
    {
        return view('admin.course.show', [
            'course' => $course,
        ]);
    }



    /**
     *Permet d'afficher un formulaire d'edition d'un cours
     * @param \App\Models\Course $course
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Course $course): View
    {
        return view('admin.course.edit', [
            'course' => $course,
        ]);
    }

    /**
     * Permet de modifier un cours
     * @param \App\Http\Requests\Admin\CourseRequest $request
     * @param \App\Models\Course $course
     * @return RedirectResponse
     */
    public function update(CourseRequest $request, Course $course): RedirectResponse
    {
        $course->update([
            'name' => $request->validated('name'),
            'credits' => $request->validated('credits'),
            'description' => $request->validated('description'),
            'professor_id' => $request->validated('professor_id'),
            'semester_id' => $request->validated('semester_id'),
            'group_id' => $request->validated('group_id'),
        ]);

        $course->levels()->sync($request->validated('levels'));
        $course->students()->sync($request->validated('students'));

        return redirect()->route('~course.index')
            ->with('success', 'cours modifiée');
    }

    /**
     * Permte de supprimer un cours
     * @param \App\Models\Course $course
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Course $course): RedirectResponse
    {
        $course->delete();

        return redirect()->route('~course.index')
            ->with('success', 'cours supprimé');
    }
}
