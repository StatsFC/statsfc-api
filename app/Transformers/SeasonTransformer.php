<?php
namespace App\Transformers;

class SeasonTransformer extends Transformer
{
    /**
     * Transform a season
     *
     * @param  $season
     * @return array
     */
    public function transform($season)
    {
        return [
            'id'   => $season->id,
            'name' => $season->name,
        ];
    }
}
