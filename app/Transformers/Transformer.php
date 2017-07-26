<?php

namespace App\Transformers;

abstract class Transformer {

    public function transformCollection($items)
    {
        if (is_null($items) || ! is_array($items)) {
            return null;
        }

        return array_map([$this, 'transform'], $items);
    }

    public abstract function transform($item);

}
