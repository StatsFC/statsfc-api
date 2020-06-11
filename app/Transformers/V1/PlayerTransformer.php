<?php
namespace App\Transformers\V1;

use App\Transformers\Transformer;

class PlayerTransformer extends Transformer
{
    /**
     * Transform a player
     *
     * @param  $player
     * @return array
     */
    public function transform($player)
    {
        return [
            'id'        => $player->id,
            'name'      => $player->name,
            'shortName' => $player->shortName,
            'position'  => $player->position,
        ];
    }
}
