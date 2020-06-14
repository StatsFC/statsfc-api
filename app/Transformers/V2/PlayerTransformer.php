<?php
namespace App\Transformers\V2;

use App\Models\V2\Player;
use App\Transformers\Transformer;

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
