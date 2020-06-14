<?php
namespace App\Transformers;

use App\Models\Player;

class PlayerTransformer extends Transformer
{
    public function transform($player)
    {
        return [
            'id'       => $player->id,
            'name'     => $player->name,
            'position' => (
            array_key_exists($player->position, Player::POSITION_MAP)
                ? Player::POSITION_MAP[$player->position]
                : null
            ),
        ];
    }
}
