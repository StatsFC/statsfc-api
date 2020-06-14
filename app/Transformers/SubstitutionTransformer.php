<?php
namespace App\Transformers;

class SubstitutionTransformer extends Transformer
{
    public function transform($event)
    {
        $data = [
            'id'        => $event->id,
            'matchTime' => $event->matchTime(),
            'type'      => 'substitution',
            'subType'   => null,
        ];

        if ($event->team) {
            $data['team'] = (new TeamTransformer)->transform($event->team);
        }

        if ($event->player && $event->assist) {
            $data['playerOff'] = (new PlayerTransformer)->transform($event->player);
            $data['playerOn']  = (new PlayerTransformer)->transform($event->assist);
        }

        return $data;
    }
}
