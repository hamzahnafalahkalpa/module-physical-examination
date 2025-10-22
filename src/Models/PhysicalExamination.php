<?php

namespace Hanafalah\ModulePhysicalExamination\Models;

use Hanafalah\ModuleExamination\Models\Examination\Assessment\Assessment;
use Illuminate\Database\Eloquent\Model;

class PhysicalExamination extends Assessment
{
    protected $table        = 'assessments';
    public $response_model  = 'array';
    public $specific = [
        'anatomy_id',
        'anatomy_name',
        'coordinate',
        'condition'
    ];

    public function getExamResults(?Model $model = null): array
    {
        $model ??= $this;
        $anatomy = $this->AnatomyModel()->findOrFail($model->anatomy_id);
        return [
            'anatomy_id'   => $model->anatomy_id,
            'anatomy_name' => $anatomy->name,
            'coordinate'   => $model->coordinate,
            'condition'    => $model->condition
        ];
    }
}
