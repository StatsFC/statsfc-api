<?php
namespace App\Transformers\V1;

use App\Transformers\Transformer;

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
        $roundTransformer       = new RoundTransformer;
        $teamTransformer        = new TeamTransformer;

        return [
            'competition'  => $competitionTransformer->transform($standing->competition, false),
            'round'        => $roundTransformer->transform($standing->round),
            'team'         => $teamTransformer->transform($standing->team),
            'position'     => $standing->position,
            'played'       => $standing->played,
            'wins'         => $standing->wins,
            'draws'        => $standing->draws,
            'losses'       => $standing->losses,
            'for'          => $standing->for,
            'against'      => $standing->against,
            'difference'   => $standing->difference,
            'points'       => $standing->points,
            'info'         => $standing->class,
            'notes'        => $standing->notes,
        ];
    }
}
