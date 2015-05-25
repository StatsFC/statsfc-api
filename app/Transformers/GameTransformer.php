<?php
namespace App\Transformers;

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
        $eventTransformer       = new EventTransformer;
        $gamePlayerTransformer  = new GamePlayerTransformer;
        $roundTransformer       = new RoundTransformer;
        $stateTransformer       = new StateTransformer;
        $teamTransformer        = new TeamTransformer;
        $venueTransformer       = new VenueTransformer;

        $score = null;

        if ($game->hasEnded()) {
            $score = [
                $game->homeGoals,
                $game->awayGoals
            ];
        }

        $homePlayers = $game->players()->hasRole()->where('team_id', $game->home_id)->orderByPosition()->get();
        $awayPlayers = $game->players()->hasRole()->where('team_id', $game->away_id)->orderByPosition()->get();

        return [
            'id'           => $game->id,
            'timestamp'    => $game->timestamp->toIso8601String(),
            'competition'  => $competitionTransformer->transform($game->round->competition, false),
            'round'        => $roundTransformer->transform($game->round),
            'teams'        => [
                'home' => $teamTransformer->transform($game->home),
                'away' => $teamTransformer->transform($game->away)
            ],
            'players'      => [
                'home' => $gamePlayerTransformer->transformCollection($homePlayers->all()),
                'away' => $gamePlayerTransformer->transformCollection($awayPlayers->all())
            ],
            'score'        => $score,
            'currentState' => $stateTransformer->transform($game->state),
            'venue'        => $venueTransformer->transform($game->venue),
            'events'       => $eventTransformer->transformCollection($game->events->all())
        ];
    }
}
