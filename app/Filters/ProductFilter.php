<?php declare(strict_types=1);

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Str;

class ProductFilter
{
    private const FILTERS_PATH = "\\App\Filters\\Type\\";

    public function __construct(private array $declaredFilters)
    {
    }

    public function filter(Builder $builder)
    {
        // @todo: Don't forget to specify category_id
        $builder->whereHas('filterOptions', function (Builder $query) {
            foreach ($this->declaredFilters as $data) {
                $this->resolveFilterClass($data['type'])->filter($query, $data);
            }
        });
    }

    public function resolveFilterClass($declaredFilterKey)
    {
        $filterType = Str::studly($declaredFilterKey);
        $className = static::FILTERS_PATH . $filterType . "Filter";
        $classInstance = app($className);
        return $classInstance;
    }
}
