<?php
namespace App\Transformers;

class TeamTransformer extends Transformer
{
    public function transform($team)
    {
        return [
            'id'        => $team->id,
            'name'      => $team->name,
            'shortName' => $team->short_name,
        ];
    }
}
