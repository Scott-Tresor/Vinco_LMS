<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\ExerciseRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExerciceUpdateRequest;
use App\Http\Requests\ExerciseRequest;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;

class ExerciseBackendController extends Controller
{
    public function __construct(
        protected readonly ExerciseRepositoryInterface $repository,
        protected readonly SweetAlertFactory $factory
    ) {
    }

    public function index(): Renderable
    {
        $exercises = $this->repository->exercises();

        return view('backend.domain.academic.exercises.index', compact('exercises'));
    }

    public function create(): Renderable
    {
        return view('backend.domain.academic.exercises.create');
    }

    public function store(ExerciseRequest $attributes): RedirectResponse
    {
        $this->repository->stored(attributes: $attributes, factory: $this->factory);

        return redirect()->route('admins.academic.exercice.index');
    }

    public function show(string $key): Factory|View|Application
    {
        $exercise = $this->repository->showExercise(key:  $key);

        return view('backend.domain.academic.exercises.show', compact('exercise'));
    }

    public function edit(string $key): HttpResponse
    {
        $exercise = $this->repository->showExercise(key:  $key);

        return Response::view('backend.domain.academic.exercises.edit', compact('exercise'));
    }

    public function update(string $key, ExerciceUpdateRequest $attributes): RedirectResponse
    {
        $this->repository->updated(key: $key, attributes: $attributes, factory: $this->factory);

        return redirect()->route('admins.academic.exercice.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key, factory: $this->factory);

        return back();
    }
}
