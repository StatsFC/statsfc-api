<?php
namespace App\Transformers;

use App\Models\Player;

class AssistTransformer extends Transformer
{
    /**
     * Transform an assist
     *
     * @param  $assist
     * @return array
     */
    public function transform($assist)
    {
        return [
            'id'       => $assist->id,
            'name'     => $assist->name,
            'position' => (
                array_key_exists($assist->position, Player::POSITION_MAP)
                    ? Player::POSITION_MAP[$assist->position]
                    : null
            ),
        ];
    }
}
