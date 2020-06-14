<?php
namespace App\Transformers\V2;

use App\Transformers\Transformer;

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
