<?php
namespace App\Transformers\V2;

use App\Models\V2\Player;
use App\Transformers\Transformer;

class AssistTransformer extends Transformer
{
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
