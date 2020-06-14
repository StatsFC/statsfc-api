<?php
namespace App\Transformers;

class SquadTransformer extends Transformer
{
    public function transform($team)
    {
        return [
            'team'    => (new TeamTransformer)->transform($team),
            'players' => (new PlayerTransformer)->transformCollection($team->players()->get()->all()),
        ];
    }
}
