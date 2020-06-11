<?php
namespace App\Transformers\V1;

use App\Transformers\Transformer;

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
        $start = $season->start;
        $end   = $season->end;

        if (! is_null($start)) {
            $start = $start->toDateString();
        }

        if (! is_null($end)) {
            $end = $end->toDateString();
        }

        $data = [
            'id'    => $season->id,
            'name'  => $season->name,
            'start' => $start,
            'end'   => $end,
        ];

        return $data;
    }
}
