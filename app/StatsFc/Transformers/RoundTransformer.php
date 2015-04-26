<?php namespace App\StatsFc\Transformers;

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
        $start = $round->start;
        $end   = $round->end;

        if (! is_null($start)) {
            $start = $start->toDateString();
        }

        if (! is_null($end)) {
            $end = $end->toDateString();
        }

        return [
            'id'    => $round->id,
            'name'  => $round->name,
            'start' => $start,
            'end'   => $end
        ];
    }
}
