<?php namespace App\StatsFc\Transformers;

class CompetitionTransformer extends Transformer
{
    /**
     * Transform a competition
     *
     * @param  $competition
     * @return array
     */
    public function transform($competition)
    {
        return [
            'id'     => (int) $competition['id'],
            'name'   => $competition['name'],
            //'region' => $competition->region->name
        ];
    }
}
