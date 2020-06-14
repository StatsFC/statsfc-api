<?php
namespace App\Transformers\V2;

use App\Transformers\Transformer;

class TopScorerTransformer extends Transformer
{
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