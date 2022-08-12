<?php declare(strict_types=1);

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Str;
use DB;

class ProductFilter
{
    private const FILTERS_PATH = "\\App\Filters\\Type\\";

    public function __construct(private array $declaredFilters)
    {
    }

    public function filter(Builder $builder)
    {
        // @todo: Don't forget to specify category_id
        $builder->select('*')
        ->whereHas('filterOptions', function (Builder $query) {
            foreach ($this->declaredFilters as $index => $data) {
                $filterQuery = function (Builder $query) use ($data) {
                    $this->resolveFilterClass($data['type'])->filter($query, $data);
                };

                if ($index >= 1) {
                    $query->orWhere($filterQuery);
                } else {
                    $query->where($filterQuery);
                }

                $query->select('*', DB::raw('count(*) as count'))
                    ->groupBy('filter_option_product.product_id')
                    ->having('count', '=', count($this->declaredFilters));
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
