<?php
namespace App\Transformers\V1;

use App\Transformers\Transformer;

class GamePlayerTransformer extends Transformer
{
    /**
     * Transform a game player
     *
     * @param  $gamePlayer
     * @return array
     */
    public function transform($gamePlayer)
    {
        $name      = null;
        $shortName = null;

        if ($gamePlayer->player) {
            $name      = $gamePlayer->player->name;
            $shortName = $gamePlayer->player->shortName;
        }

        return [
            'id'        => $gamePlayer->player_id,
            'number'    => $gamePlayer->number,
            'position'  => $gamePlayer->position,
            'role'      => $gamePlayer->role,
            'name'      => $name,
            'shortName' => $shortName,
        ];
    }
}
