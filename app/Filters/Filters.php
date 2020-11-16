<?php


namespace App\Filters;
use Illuminate\Http\Request;


abstract class Filters {

    protected $builder;
    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($builder) {

        $this->builder = $builder;

        foreach($this->getFilters() as $filter => $value) {

            if(method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }


        return $this->builder;

    }

    public function getFilters() {
        $filters = array_intersect(array_keys($this->request->all()), $this->filters);
        return $this->request->only($filters);
    }

}
