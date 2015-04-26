<?php
namespace App\Transformers;

use App\Transformers\RoundTransformer;

class GameTransformer extends Transformer
{
    /**
     * Transform a game
     *
     * @param  $game
     * @return array
     */
    public function transform($game)
    {
        $roundTransformer = new RoundTransformer;

        return [
            'id'        => $game->id,
            'timestamp' => $game->timestamp->toIso8601String(),
            'round'     => $roundTransformer->transform($game->round)
        ];
    }
}
