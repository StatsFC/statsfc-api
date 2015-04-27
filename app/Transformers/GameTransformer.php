<?php
namespace App\Transformers;

use App\Transformers\CompetitionTransformer;
use App\Transformers\RoundTransformer;
use App\Transformers\TeamTransformer;

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
        $competitionTransformer = new CompetitionTransformer;
        $roundTransformer       = new RoundTransformer;
        $teamTransformer        = new TeamTransformer;
        $stateTransformer       = new StateTransformer;

        $score = null;

        if ($game->hasEnded()) {
            $score = [
                $game->homeGoals,
                $game->awayGoals
            ];
        }

        return [
            'id'           => $game->id,
            'timestamp'    => $game->timestamp->toIso8601String(),
            'competition'  => $competitionTransformer->transform($game->round->competition, false),
            'round'        => $roundTransformer->transform($game->round),
            'teams'        => [
                'home' => $teamTransformer->transform($game->home),
                'away' => $teamTransformer->transform($game->away)
            ],
            'score'        => $score,
            'currentState' => $stateTransformer->transform($game->state),
            'events'       => []
        ];
    }
}
