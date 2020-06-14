<?php
namespace App\Transformers;

class GoalTransformer extends Transformer
{
    /**
     * Transform a goal
     *
     * @param  $goal
     * @return array
     */
    public function transform($goal)
    {
        $assistTransformer = new AssistTransformer;
        $playerTransformer = new PlayerTransformer;
        $teamTransformer   = new TeamTransformer;

        $data = [
            'id'        => $goal->id,
            'timestamp' => $goal->timestamp->toIso8601String(),
            'matchTime' => $goal->matchTime,
            'type'      => 'goal',
            'subType'   => $goal->subType,
        ];

        if ($goal->team) {
            $data['team'] = $teamTransformer->transform($goal->team);
        }

        if ($goal->player) {
            $data['player'] = $playerTransformer->transform($goal->player);
        }

        if ($goal->assist) {
            $data['assist'] = $assistTransformer->transform($goal->assist);
        }

        return $data;
    }
}
