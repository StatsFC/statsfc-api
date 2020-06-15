<?php
namespace App\Transformers;

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
            'matchTime' => $substitution->matchTime(),
            'type'      => 'substitution',
            'subType'   => null,
        ];

        if ($substitution->team) {
            $data['team'] = $teamTransformer->transform($substitution->team);
        }

        if ($substitution->player && $substitution->assist) {
            $data['playerOff'] = $playerTransformer->transform($substitution->player);
            $data['playerOn']  = $playerTransformer->transform($substitution->assist);
        }

        return $data;
    }
}
