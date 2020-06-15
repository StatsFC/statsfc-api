<?php
namespace App\Transformers;

class StandingTransformer extends Transformer
{
    /**
     * Transform a standing
     *
     * @param  $standing
     * @return array
     */
    public function transform($standing)
    {
        $competitionTransformer = new CompetitionTransformer;
        $seasonTransformer      = new SeasonTransformer;
        $teamTransformer        = new TeamTransformer;

        return [
            'season'      => $seasonTransformer->transform($standing->season),
            'competition' => $competitionTransformer->transform($standing->competition, false),
            'group'       => $standing->group,
            'team'        => $teamTransformer->transform($standing->team),
            'position'    => $standing->position,
            'played'      => $standing->played,
            'wins'        => $standing->won,
            'draws'       => $standing->drawn,
            'losses'      => $standing->lost,
            'for'         => $standing->goals_for,
            'against'     => $standing->goals_against,
            'difference'  => $standing->goal_difference,
            'points'      => $standing->points,
            'notes'       => $standing->description,
        ];
    }
}
