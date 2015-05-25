<?php
namespace App\Transformers;

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
            'position'  => $player->position
        ];
    }
}
