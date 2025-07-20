<?php

namespace Hanafalah\ModulePhysicalExamination\Schemas;

use Hanafalah\ModuleExamination\Contracts\Data\AssessmentData;
use Hanafalah\ModuleExamination\Schemas\Examination\Assessment\Assessment;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModulePhysicalExamination\Contracts;

class PhysicalExamination extends Assessment implements Contracts\Schemas\PhysicalExamination
{
    protected string $__entity = 'PhysicalExamination';
    public $physicalExamination_model;

    public function prepareStore(AssessmentData $assessment_dto): Model
    {
        $attributes ??= request()->all();

        $anatomy = $this->AnatomyModel()->findOrFail($attributes['anatomy_id']);
        $attributes['anatomy_name'] = $anatomy->name;
        $this->prepareStoreAssessment($attributes);
        $this->addPatientPhysicalExamination($attributes);

        $this->setAssessmentProp($attributes);
        static::$assessment_model->save();
        return $this->assessment_model;
    }

    public function addPatientPhysicalExamination(?array $attributes = null): Model
    {
        $attributes['patient_id']     = static::$__patient->getKey();
        $attributes['reference_id']   = static::$assessment_model->getKey();
        $attributes['reference_type'] = static::$assessment_model->morph;

        $patient_physical_examination_schema = $this->schemaContract('patient_physical_examination');
        return $patient_physical_examination_schema->prepareStorePatientPhysicalExamination($attributes);
    }
}
