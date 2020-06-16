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
                'name' => $topScorer->player_name,
            ],
            'team'   => [
                'name'      => $topScorer->team_name,
                'shortName' => $topScorer->team_short_name,
            ],
            'goals'  => (int) $topScorer->goals,
        ];
    }
}
