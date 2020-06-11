<?php
namespace App\Transformers\V1;

use App\Transformers\Transformer;

class VenueTransformer extends Transformer
{
    /**
     * Transform a venue
     *
     * @param  $venue
     * @return array
     */
    public function transform($venue)
    {
        return [
            'id'       => $venue->id,
            'name'     => $venue->name,
            'capacity' => $venue->capacity,
        ];
    }
}
