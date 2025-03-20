<?php

namespace Hanafalah\ModulePhysicalExamination\Models;

use Hanafalah\ModuleExamination\Models\Examination\Assessment\Assessment;

class PhysicalExamination extends Assessment
{
    protected $table        = 'assessments';
    public $response_model  = 'array';
    public $specific = [
        'anatomy_id',
        'anatomy_name',
        'coordinate',
        'condition',
        'is_permanent'
    ];

    public function getExamResults($model): array
    {
        $anatomy = $this->AnatomyModel()->findOrFail($model->anatomy_id);
        return [
            'anatomy_id'   => $model->anatomy_id,
            'anatomy_name' => $anatomy->name,
            'coordinate'   => $model->coordinate,
            'condition'    => $model->condition,
            'is_permanent' => $model->is_permanent
        ];
    }
}
