<?php
namespace App\Transformers;

class EventTransformer extends Transformer
{
    /**
     * Transform a event
     *
     * @param  $event
     * @return array
     */
    public function transform($event)
    {
        $playerTransformer = new PlayerTransformer;
        $stateTransformer  = new StateTransformer;
        $teamTransformer   = new TeamTransformer;

        $data = [
            'id'        => $event->id,
            'timestamp' => $event->timestamp->toIso8601String(),
            'matchTime' => $event->matchTime,
            'type'      => $event->type,
            'subType'   => $event->subType
        ];

        if ($event->team) {
            $data['team'] = $teamTransformer->transform($event->team);
        }

        if ($event->state) {
            $data['state'] = $stateTransformer->transform($event->state);
        }

        if ($event->player) {
            if ($event->player2) {
                $data['playerOff'] = $playerTransformer->transform($event->player);
                $data['playerOn']  = $playerTransformer->transform($event->player2);
            } else {
                $data['player'] = $playerTransformer->transform($event->player);
            }
        }

        return $data;
    }
}
