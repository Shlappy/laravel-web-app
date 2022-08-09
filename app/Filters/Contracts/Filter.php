<?php declare(strict_types=1);

namespace App\Filters\Contracts;

interface Filter
{
    /**
     * Apply filter and return builder instance
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  string  $value
     * @return  \Illuminate\Database\Eloquent\Builder
     */
    public function filter(\Illuminate\Database\Eloquent\Builder $builder, string $value);
}
