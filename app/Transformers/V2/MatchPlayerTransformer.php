<?php
namespace App\Transformers\V2;

use App\Transformers\Transformer;

class MatchPlayerTransformer extends Transformer
{
    public function transform($matchPlayer)
    {
        $name     = null;
        $position = null;

        if ($player = $matchPlayer->player) {
            $name     = $player->name;
            $position = $player->position;
        }

        return [
            'id'       => $matchPlayer->player_id,
            'number'   => $matchPlayer->number,
            'position' => $position,
            'role'     => $matchPlayer->role,
            'name'     => $name,
        ];
    }
}
