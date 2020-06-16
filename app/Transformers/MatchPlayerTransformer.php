<?php
namespace App\Transformers;

use App\Models\Player;

class MatchPlayerTransformer extends Transformer
{
    /**
     * Transform a match player
     *
     * @param  $matchPlayer
     * @return array
     */
    public function transform($matchPlayer)
    {
        $name     = null;
        $position = null;

        if ($matchPlayer->player) {
            $name     = $matchPlayer->player->name;
            $position = (
                array_key_exists($matchPlayer->player->position, Player::POSITION_MAP)
                    ? Player::POSITION_MAP[$matchPlayer->player->position]
                    : null
            );
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
