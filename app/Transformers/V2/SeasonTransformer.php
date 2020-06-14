<?php
namespace App\Transformers\V2;

use App\Transformers\Transformer;

class SeasonTransformer extends Transformer
{
    public function transform($season)
    {
        return [
            'id'   => $season->id,
            'name' => $season->name,
        ];
    }
}
