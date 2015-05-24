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
        $data = [
            'id'    => $season->id,
            'name'  => $season->name,
            'start' => $season->start,
            'end'   => $season->end
        ];

        return $data;
    }
}
