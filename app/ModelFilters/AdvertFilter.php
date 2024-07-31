<?php

namespace App\ModelFilters;


use EloquentFilter\ModelFilter;

class AdvertFilter extends ModelFilter
{

    public function id ($value): AdvertFilter
    {
        return $this->where('id', $value);
    }

    public function title ($value): AdvertFilter
    {
        return $this->where('title', $value);
    }

    public function description ($value): AdvertFilter
    {
        return $this->where('description', $value);
    }

    public function price ($value): AdvertFilter
    {
        return $this->where('price', $value);
    }


}
