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
    public function transform($round, $includeSeason = true)
    {
        $data = [
            'id'   => $round->id,
            'name' => $round->name,
        ];

        if ($includeSeason) {
            $data['season'] = (new SeasonTransformer)->transform($round->season);
        }

        return $data;
    }
}
