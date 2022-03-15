<?php


namespace App\Filters;


use Filter\Filter;

class ProductFilter extends Filter
{
    public function filterName($name)
    {
        $this->query->where('name', 'like', "%$name%");
    }

    public function filterPrice($price)
    {
        $this->query->where('price', $price);
    }

    public function filterFromPrice($value)
    {
        $this->query->where('price', '>', $value);
    }

    public function filterToPrice($value)
    {
        $this->query->where('price', '<', $value);
    }

    public function filterCategory($category)
    {
        $this->query->whereRelation('category', 'name', '=', $category);
    }
}
