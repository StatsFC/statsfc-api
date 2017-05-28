<?php
namespace App\Transformers;

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
