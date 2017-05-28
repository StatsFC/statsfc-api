<?php
namespace App\Transformers;

class TopScorerTransformer extends Transformer
{
    /**
     * Transform a top scorer
     *
     * @param  $topScorer
     * @return array
     */
    public function transform($topScorer)
    {
        return [
            'id'     => $topScorer->id,
            'player' => [
                'name'      => $topScorer->playerName,
                'shortName' => $topScorer->playerShortName,
            ],
            'team'   => [
                'name'      => $topScorer->teamName,
                'shortName' => $topScorer->teamShortName,
            ],
            'goals'  => (int) $topScorer->goals,
        ];
    }
}
