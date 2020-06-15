<?php
namespace App\Transformers;

class RoundTransformer extends Transformer
{
    /**
     * Transform a round
     *
     * @param  $round
     * @return array
     */
    public function transform($round)
    {
        return [
            'id'     => $round->id,
            'name'   => $round->name,
            'season' => (new SeasonTransformer)->transform($round->season),
        ];
    }
}
