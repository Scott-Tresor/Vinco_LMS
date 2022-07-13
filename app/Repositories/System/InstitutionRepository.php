<?php

declare(strict_types=1);

namespace App\Repositories\System;

use App\Contracts\InstitutionRepositoryInterface;
use App\Models\Institution;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use LaravelIdea\Helper\App\Models\_IH_Institution_QB;

class InstitutionRepository implements InstitutionRepositoryInterface
{
    use ImageUploader;

    public function getInstitutions(): array|Collection|\Illuminate\Support\Collection
    {
        return Institution::query()
            ->with(['campuses', 'events'])
            ->orderByDesc('created_at')
            ->get();
    }

    public function showInstitution(string $key): Model|Institution|Builder|_IH_Institution_QB
    {
        $institution = Institution::query()
            ->whereId($key)
            ->firstOrFail();

        return $institution->load(['campuses', 'events']);
    }

    public function stored($attributes, $factory): Model|Institution|Builder|RedirectResponse
    {
        $institution = Institution::query()
            ->where('user_id', '=', $attributes->input('manager'))
            ->first();

        if (! $institution) {
            return Institution::query()
                ->create([
                    'institution_name' => $attributes->input('institution_name'),
                    'user_id' => $attributes->input('manager'),
                    'institution_address' => $attributes->input('institution_address'),
                    'institution_country' => $attributes->input('institution_country'),
                    'institution_phones' => $attributes->input('institution_phones'),
                    'institution_town' => $attributes->input('institution_town'),
                    'institution_images' => self::uploadFiles($attributes),
                    'institution_website' => $attributes->input('institution_website'),
                    'institution_email' => $attributes->input('institution_email'),
                    'institution_description' => $attributes->input('institution_description'),
                ]);
        }

        $factory->addError('Le gestionnaire a ete deja affecter a une autre institution');

        return back();
    }

    public function updated(string $key, $attributes): Model|Institution|Builder|_IH_Institution_QB
    {
        $institution = $this->showInstitution(key: $key);
        $this->removePathOfInstitution(model: $institution);
        $institution->update([
            'institution_name' => $attributes->input('institution_name'),
            'user_id' => $attributes->input('manager'),
            'institution_address' => $attributes->input('institution_address'),
            'institution_country' => $attributes->input('institution_country'),
            'institution_phones' => $attributes->input('institution_phones'),
            'institution_town' => $attributes->input('institution_town'),
            'institution_images' => self::uploadFiles($attributes),
            'institution_website' => $attributes->input('institution_website'),
            'institution_email' => $attributes->input('institution_email'),
            'institution_description' => $attributes->input('institution_description'),
            'institution_start_time' => $attributes->input('institution_start_time'),
            'institution_end_time' => $attributes->input('institution_end_time'),
            'institution_routine_time' => $attributes->input('institution_routine'),
        ]);

        return $institution;
    }

    public function deleted(string $key): Model|Institution|Builder|_IH_Institution_QB
    {
        $institution = $this->showInstitution(key: $key);
        $institution->delete();

        return $institution;
    }
}
