<?php declare(strict_types=1);

namespace App\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface Filter
{
    public function filter(Builder $builder, array $data): void;
}