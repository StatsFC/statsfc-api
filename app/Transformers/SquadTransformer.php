<?php
namespace App\Transformers;

class SquadTransformer extends Transformer
{
    /**
     * Transform a squad
     *
     * @param  $team
     * @return array
     */
    public function transform($team)
    {
        $playerTransformer = new PlayerTransformer;
        $teamTransformer   = new TeamTransformer;

        $players = $team->players()->get();

        return [
            'team'    => $teamTransformer->transform($team),
            'players' => $playerTransformer->transformCollection($players->all())
        ];
    }
}
