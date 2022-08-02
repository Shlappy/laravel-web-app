<?php

declare(strict_types=1);

namespace App\Services\Filter;

class FiltersService
{
    /**
     * Prepare filters for output to a component
     * 
     * @param Collection $filters Raw filters to be processed
     */
    public function filterResponse($filters)
    {
        $filters = $filters->groupBy('name');
        $outputFilters = [];

        foreach ($filters as $name => $filter) {

            $filterData = [
                'name' => $name,
                'slug' => $filter->first()->slug,
                'type' => $filter->first()->type,
            ];

            switch ($filter->first()->type) {
                case 'between':
                    $betweenValues = [];

                    foreach ($filter as $filterItem) {
                        $betweenValues[] = $filterItem->value;
                    }

                    $filterData += [
                        'min' => min($betweenValues),
                        'max' => max($betweenValues),
                    ];

                    break;

                case 'checkbox':
                    $filterData['values'] = [];

                    foreach ($filter as $filterItem) {
                        if (array_key_exists($filterItem->value, $filterData['values'])) continue;
                        $filterData['values'][$filterItem->value] = [
                            'value' => $filterItem->value,
                            'code' => $filterItem->code,
                        ];
                    }

                    break;

                default:
                    break;
            }

            $outputFilters[] = $filterData;
        }

        return $outputFilters;
    }
}
