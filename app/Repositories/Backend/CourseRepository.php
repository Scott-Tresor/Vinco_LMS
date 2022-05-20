<?php
declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Enums\StatusEnum;
use App\Interfaces\CourseRepositoryInterface;
use App\Models\Course;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

class CourseRepository implements CourseRepositoryInterface
{
    use ImageUploader;

    public function getCourses(): array|Collection
    {
        return Course::query()
            ->with('category')
            ->orderByDesc('created_at')
            ->get();
    }

    public function showCourse(string $key)
    {
        $course = Course::query()
            ->when('key', function ($query) use ($key){
                $query->where('key', $key);
            })
            ->first();
        return $course->load('category');
    }

    public function stored($attributes, $flash): Model|Builder|Course
    {
        $course = Course::query()
            ->create([
                'category_id' => $attributes->input(''),
                'user_id' => $attributes->input(''),
                'name' => $attributes->input(''),
                'subDescription' => $attributes->input(''),
                'description' => $attributes->input(''),
                'images' => self::uploadFiles($attributes),
                'startDate' => $attributes->input(''),
                'endDate' => $attributes->input(''),
                'duration' => $attributes->input(''),
                'status' => StatusEnum::FALSE,
                'academic_year_id' => $attributes->input('')
            ]);
        $flash->addSuccess("Un nouveau cours a ete ajouter");
        return $course;
    }

    public function updated(string $key, $attributes, $flash)
    {
        $course = $this->showCourse(key: $key);
        $course->update([
            'category_id' => $attributes->input(''),
            'user_id' => $attributes->input(''),
            'name' => $attributes->input(''),
            'subDescription' => $attributes->input(''),
            'description' => $attributes->input(''),
            'startDate' => $attributes->input(''),
            'endDate' => $attributes->input(''),
            'duration' => $attributes->input(''),
            'academic_year_id' => $attributes->input('')
        ]);
        $flash->addSuccess("Un nouveau cours a ete ajouter");
        return $course;
    }

    public function deleted(string $key, $flash): RedirectResponse
    {
        $professor = $this->showCourse(key: $key);
        if ($professor->status !== StatusEnum::FALSE){
            $flash->addError("Veillez desactiver le cours avant de le mettre dans la corbeille");
            return back();
        }
        $professor->delete();
        $flash->addSuccess('Une modification a ete effectuer sur ce cours');
        return back();
    }

    public function changeStatus($attributes): bool|int
    {
        $professor = $this->showCourse(key: $attributes->input('key'));
        if ($professor != null){
            return $professor->update([
                'status' => $attributes->input('status')
            ]);
        }
        return false;
    }
}