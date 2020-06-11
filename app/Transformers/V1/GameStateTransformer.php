<?php
namespace App\Transformers\V1;

use App\Transformers\Transformer;

class GameStateTransformer extends Transformer
{
    /**
     * Transform a game state
     *
     * @param  $gameState
     * @return array
     */
    public function transform($gameState)
    {
        $stateTransformer = new StateTransformer;

        $data = [
            'id'        => $gameState->id,
            'timestamp' => $gameState->timestamp->toIso8601String(),
            'matchTime' => $gameState->matchTime,
            'type'      => 'state',
        ];

        if ($gameState->state) {
            $data['state'] = $stateTransformer->transform($gameState->state);
        }

        return $data;
    }
}
