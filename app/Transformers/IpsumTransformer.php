<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Ipsum;

class IpsumTransformer extends TransformerAbstract {

    public function transform(Ipsum $ipsum)
    {
        return [
            'id' => (int) $ipsum->id,
            'content' => $ipsum->content
        ];
    }

}
