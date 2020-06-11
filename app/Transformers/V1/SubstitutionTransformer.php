<?php
namespace App\Transformers\V1;

use App\Transformers\Transformer;

class SubstitutionTransformer extends Transformer
{
    /**
     * Transform a substitution
     *
     * @param  $substitution
     * @return array
     */
    public function transform($substitution)
    {
        $playerTransformer = new PlayerTransformer;
        $teamTransformer   = new TeamTransformer;

        $data = [
            'id'        => $substitution->id,
            'timestamp' => $substitution->timestamp->toIso8601String(),
            'matchTime' => $substitution->matchTime,
            'type'      => 'substitution',
            'subType'   => $substitution->subType,
        ];

        if ($substitution->team) {
            $data['team'] = $teamTransformer->transform($substitution->team);
        }

        if ($substitution->player && $substitution->player2) {
            $data['playerOff'] = $playerTransformer->transform($substitution->player);
            $data['playerOn']  = $playerTransformer->transform($substitution->player2);
        }

        return $data;
    }
}
