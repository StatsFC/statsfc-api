<?php
namespace App\Transformers;

use App\Transformers\RoundTransformer;

class CompetitionTransformer extends Transformer
{
    /**
     * Transform a competition
     *
     * @param  $competition
     * @return array
     */
    public function transform($competition, $includeRounds = true)
    {
        $data = [
            'id'     => $competition->id,
            'name'   => $competition->name,
            'region' => $competition->region->name
        ];

        if ($includeRounds) {
            $roundTransformer = new RoundTransformer;

            $data['rounds'] = $roundTransformer->transformCollection($competition->rounds()->active()->get()->all());
        }

        return $data;
    }
}
