<?php
namespace App\Transformers;

class CardTransformer extends Transformer
{
    /**
     * Transform a card
     *
     * @param  $card
     * @return array
     */
    public function transform($card)
    {
        $playerTransformer = new PlayerTransformer;
        $teamTransformer   = new TeamTransformer;

        $data = [
            'id'        => $card->id,
            'timestamp' => $card->timestamp->toIso8601String(),
            'matchTime' => $card->matchTime,
            'type'      => 'card',
            'subType'   => $card->subType,
        ];

        if ($card->team) {
            $data['team'] = $teamTransformer->transform($card->team);
        }

        if ($card->player) {
            $data['player'] = $playerTransformer->transform($card->player);
        }

        return $data;
    }
}
