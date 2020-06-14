<?php
namespace App\Transformers\V2;

use App\Transformers\Transformer;

class CompetitionTransformer extends Transformer
{
    public function transform($competition, $includeRounds = true)
    {
        $data = [
            'id'      => $competition->id,
            'name'    => $competition->name,
            'key'     => $competition->key,
            'country' => $competition->country,
        ];

        if ($includeRounds) {
            $roundTransformer = new RoundTransformer;

            $rounds = $competition->rounds()->get();

            $data['rounds'] = $roundTransformer->transformCollection($rounds->all());
        }

        return $data;
    }
}
