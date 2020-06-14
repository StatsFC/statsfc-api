<?php
namespace App\Transformers;

class CardTransformer extends Transformer
{
    public function transform($event)
    {
        $data = [
            'id'        => $event->id,
            'matchTime' => $event->matchTime(),
            'type'      => 'card',
            'subType'   => $event->subType(),
        ];

        if ($event->team) {
            $data['team'] = (new TeamTransformer)->transform($event->team);
        }

        if ($event->player) {
            $data['player'] = (new PlayerTransformer)->transform($event->player);
        }

        return $data;
    }
}
