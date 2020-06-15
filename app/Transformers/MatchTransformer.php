<?php
namespace App\Transformers;

class GameTransformer extends Transformer
{
    /**
     * Transform a match
     *
     * @param  $match
     * @return array
     */
    public function transform($match)
    {
        $cardTransformer         = new CardTransformer;
        $competitionTransformer  = new CompetitionTransformer;
        $goalTransformer         = new GoalTransformer;
        $matchPlayerTransformer  = new MatchPlayerTransformer;
        $roundTransformer        = new RoundTransformer;
        $substitutionTransformer = new SubstitutionTransformer;
        $teamTransformer         = new TeamTransformer;

        $homePlayers = $match->players()->hasRole()->where('team_id', $match->home_id)->orderByPosition()->get();
        $awayPlayers = $match->players()->hasRole()->where('team_id', $match->away_id)->orderByPosition()->get();

        return [
            'id'           => $match->id,
            'timestamp'    => $match->start->toIso8601String(),
            'competition'  => $competitionTransformer->transform($match->competition, false),
            'round'        => $roundTransformer->transform($match->round),
            'teams'        => [
                'home' => $teamTransformer->transform($match->home),
                'away' => $teamTransformer->transform($match->away),
            ],
            'players'      => [
                'home' => $matchPlayerTransformer->transformCollection($homePlayers->all()),
                'away' => $matchPlayerTransformer->transformCollection($awayPlayers->all()),
            ],
            'score'        => [
                $match->home_score,
                $match->away_score,
            ],
            'currentState' => $match->status,
            'events'       => [
                'cards'         => $cardTransformer->transformCollection($match->cards()->get()->all()),
                'goals'         => $goalTransformer->transformCollection($match->goals()->get()->all()),
                'substitutions' => $substitutionTransformer->transformCollection($match->substitutions()->get()->all()),
            ],
        ];
    }
}
