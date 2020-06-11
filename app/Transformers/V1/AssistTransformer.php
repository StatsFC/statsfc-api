<?php
namespace App\Transformers\V1;

use App\Transformers\Transformer;

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
            'id'        => $assist->id,
            'name'      => $assist->name,
            'shortName' => $assist->shortName,
            'position'  => $assist->position,
        ];
    }
}
