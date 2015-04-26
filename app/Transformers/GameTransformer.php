<?php
namespace App\Transformers;

use App\Transformers\CompetitionTransformer;
use App\Transformers\RoundTransformer;

class GameTransformer extends Transformer
{
    /**
     * Transform a game
     *
     * @param  $game
     * @return array
     */
    public function transform($game)
    {
        $roundTransformer       = new RoundTransformer;
        $competitionTransformer = new CompetitionTransformer;

        return [
            'id'          => $game->id,
            'timestamp'   => $game->timestamp->toIso8601String(),
            'round'       => $roundTransformer->transform($game->round),
            'competition' => $competitionTransformer->transform($game->round->competition, false)
        ];
    }
}
