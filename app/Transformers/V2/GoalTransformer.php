<?php
namespace App\Transformers\V2;

use App\Transformers\Transformer;

class GoalTransformer extends Transformer
{
    public function transform($event)
    {
        $data = [
            'id'        => $event->id,
            'matchTime' => $event->matchTime(),
            'type'      => 'goal',
            'subType'   => $event->subType(),
        ];

        if ($event->team) {
            $data['team'] = (new TeamTransformer)->transform($event->team);
        }

        if ($event->player) {
            $data['player'] = (new PlayerTransformer)->transform($event->player);
        }

        if ($event->assist) {
            $data['assist'] = (new PlayerTransformer)->transform($event->assist);
        }

        return $data;
    }
}
