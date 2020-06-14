<?php
namespace App\Transformers;

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
