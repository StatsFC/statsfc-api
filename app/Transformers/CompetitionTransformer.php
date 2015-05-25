<?php
namespace App\Transformers;

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
            'region' => $competition->region->name
        ];

        if ($includeRounds) {
            $roundTransformer = new RoundTransformer;

            $data['rounds'] = $roundTransformer->transformCollection($competition->rounds()->active()->get()->all());
        }

        return $data;
    }
}
