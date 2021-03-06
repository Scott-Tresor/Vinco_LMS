<?php

declare(strict_types=1);

namespace App\Contracts;

interface AcademicYearRepositoryInterface
{
    public function getAcademicsYears();

    public function showAcademicYear(string $key);

    public function stored($attributes, $flash);

    public function updated(string $key, $attributes, $flash);

    public function deleted(string $key, $flash);
}
