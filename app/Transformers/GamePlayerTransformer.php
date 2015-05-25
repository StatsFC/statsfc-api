<?php
namespace App\Transformers;

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
        return [
            'id'        => $gamePlayer->player_id,
            'number'    => $gamePlayer->number,
            'position'  => $gamePlayer->position,
            'role'      => $gamePlayer->role,
            'name'      => $gamePlayer->player->name,
            'shortName' => $gamePlayer->player->shortName
        ];
    }
}
