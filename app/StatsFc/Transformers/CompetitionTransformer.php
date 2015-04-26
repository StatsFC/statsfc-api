<?php namespace App\StatsFc\Transformers;

use App\StatsFc\Transformers\RoundTransformer;

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
        $roundTransformer = new RoundTransformer;

        return [
            'id'     => $competition->id,
            'name'   => $competition->name,
            'region' => $competition->region->name,
            'rounds' => $roundTransformer->transformCollection($competition->rounds()->active()->get()->all())
        ];
    }
}
