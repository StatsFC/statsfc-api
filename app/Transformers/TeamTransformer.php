<?php
namespace App\Transformers;

class TeamTransformer extends Transformer
{
    /**
     * Transform a team
     *
     * @param  $team
     * @return array
     */
    public function transform($team)
    {
        return [
            'id'        => $team->id,
            'name'      => $team->name,
            'shortName' => $team->shortName
        ];
    }
}
