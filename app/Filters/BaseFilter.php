<?php

declare(strict_types=1);

namespace App\Filters;


use Illuminate\Database\Eloquent\Builder;
use App;
use Str;

class BaseFilter
{
    /**
     * An instance of the current request or an input item from the request
     */
    private $request;
    
    /**
     * Current class' namespace
     */
    protected $namespace = "\\App\Filters\\";

    public function __construct(protected array $declared_filters)
    {
        $this->request = request();
    }

    /**
     * Resolve filter classes and apply them
     * 
     * @param Builder $builder
     * @return Builder New builder with filters applied
     */
    public function filter(Builder $builder)
    {
        foreach ($this->getRequestedFilters() as $filter => $value) {
            $this->resolveFilterClass($filter)->filter($builder, $value);
        }
    }

    public function getRequestedFilters()
    {
        // return array_filter($this->request->only($this->declared_filters));
        return ['limit' => '22', 'order' => 'id'];
    }

    public function resolveFilterClass($declared_filter_key)
    {
        $filter_name = Str::studly($declared_filter_key);
        $class_name = $this->namespace . $filter_name . "Filter";
        $class_instance = App::make($class_name);
        return $class_instance;
    }
}
