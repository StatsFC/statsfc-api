<?php
namespace App\Transformers\V1;

use App\Transformers\Transformer;

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
        $cardTransformer         = new CardTransformer;
        $competitionTransformer  = new CompetitionTransformer;
        $gamePlayerTransformer   = new GamePlayerTransformer;
        $gameStateTransformer    = new GameStateTransformer;
        $goalTransformer         = new GoalTransformer;
        $roundTransformer        = new RoundTransformer;
        $stateTransformer        = new StateTransformer;
        $substitutionTransformer = new SubstitutionTransformer;
        $teamTransformer         = new TeamTransformer;
        $venueTransformer        = new VenueTransformer;

        $score = null;

        if ($game->hasEnded()) {
            $score = [
                $game->homeGoals,
                $game->awayGoals,
            ];
        }

        $homePlayers = $game->players()->hasRole()->where('team_id', $game->home_id)->orderByPosition()->get();
        $awayPlayers = $game->players()->hasRole()->where('team_id', $game->away_id)->orderByPosition()->get();

        $venue = null;

        if ($game->venue) {
            $venue = $venueTransformer->transform($game->venue);
        }

        return [
            'id'           => $game->id,
            'timestamp'    => $game->timestamp->toIso8601String(),
            'competition'  => $competitionTransformer->transform($game->round->competition, false),
            'round'        => $roundTransformer->transform($game->round),
            'teams'        => [
                'home' => $teamTransformer->transform($game->home),
                'away' => $teamTransformer->transform($game->away),
            ],
            'players'      => [
                'home' => $gamePlayerTransformer->transformCollection($homePlayers->all()),
                'away' => $gamePlayerTransformer->transformCollection($awayPlayers->all()),
            ],
            'score'        => $score,
            'currentState' => $stateTransformer->transform($game->state),
            'venue'        => $venue,
            'events'       => [
                'cards'         => $cardTransformer->transformCollection($game->cards->all()),
                'goals'         => $goalTransformer->transformCollection($game->goals->all()),
                'states'        => $gameStateTransformer->transformCollection($game->gameStates->all()),
                'substitutions' => $substitutionTransformer->transformCollection($game->substitutions->all()),
            ],
        ];
    }
}
