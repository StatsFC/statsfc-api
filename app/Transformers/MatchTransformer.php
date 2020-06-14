<?php
namespace App\Transformers;

class MatchTransformer extends Transformer
{
    public function transform($match)
    {
        $homePlayers = $match->players()->hasRole()->where('team_id', $match->home_id)->orderByPosition()->get();
        $awayPlayers = $match->players()->hasRole()->where('team_id', $match->away_id)->orderByPosition()->get();

        return [
            'id'           => $match->id,
            'timestamp'    => $match->start->toIso8601String(),
            'competition'  => (new CompetitionTransformer)->transform($match->competition, false),
            'round'        => (new RoundTransformer)->transform($match->round),
            'teams'        => [
                'home' => (new TeamTransformer)->transform($match->home),
                'away' => (new TeamTransformer)->transform($match->away),
            ],
            'players'      => [
                'home' => (new MatchPlayerTransformer)->transformCollection($homePlayers->all()),
                'away' => (new MatchPlayerTransformer)->transformCollection($awayPlayers->all()),
            ],
            'score'        => [
                $match->home_score,
                $match->away_score,
            ],
            'currentState' => $match->status,
            'events'       => [
                'cards'         => (new CardTransformer)->transformCollection($match->cards()->get()->all()),
                'goals'         => (new GoalTransformer)->transformCollection($match->goals()->get()->all()),
                'substitutions' => (new SubstitutionTransformer)->transformCollection($match->substitutions()->get()->all()),
            ],
        ];
    }
}
