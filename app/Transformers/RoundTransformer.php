<?php
namespace App\Transformers;

class RoundTransformer extends Transformer
{
    public function transform($round, $includeSeason = true)
    {
        $data = [
            'id'     => $round->id,
            'name'   => $round->name,
            'type'   => $round->type,
        ];

        if ($includeSeason) {
            $data['season'] = (new SeasonTransformer)->transform($round->season);
        }

        return $data;
    }
}
