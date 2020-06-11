<?php
namespace App\Transformers\V1;

use App\Transformers\Transformer;

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
            'key'    => $competition->key,
            'region' => $competition->region->name,
        ];

        if ($includeRounds) {
            $roundTransformer = new RoundTransformer;

            $rounds = $competition->rounds()->active()->get();

            $data['rounds'] = $roundTransformer->transformCollection($rounds->all());
        }

        return $data;
    }
}
