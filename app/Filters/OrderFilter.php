<?php


namespace App\Filters;


use Filter\Filter;

class OrderFilter extends Filter
{
    public function filterProduct($product)
    {
        $this->query->whereRelation('product', 'name', '=', $product);
    }

    public function filterPaid($paid)
    {
        $this->query->where('paid', $paid);
    }

}
