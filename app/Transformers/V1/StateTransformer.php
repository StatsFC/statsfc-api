<?php
namespace App\Transformers\V1;

use App\Transformers\Transformer;

class StateTransformer extends Transformer
{
    /**
     * Transform a state
     *
     * @param  $state
     * @return array
     */
    public function transform($state)
    {
        return [
            'id'   => $state->id,
            'key'  => $state->key,
            'name' => $state->name,
        ];
    }
}
