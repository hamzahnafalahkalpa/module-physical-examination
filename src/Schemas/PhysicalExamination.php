<?php

namespace Hanafalah\ModulePhysicalExamination\Schemas;

use Hanafalah\ModuleExamination\Contracts\Data\AssessmentData;
use Hanafalah\ModuleExamination\Schemas\Examination\Assessment\Assessment;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModulePhysicalExamination\Contracts;
use Illuminate\Support\Str;

class PhysicalExamination extends Assessment implements Contracts\Schemas\PhysicalExamination
{
    protected string $__entity = 'PhysicalExamination';
    public $physicalExamination_model;

    public function prepareStore(AssessmentData $assessment_dto): Model
    {
        $assessment_exam = &$assessment_dto->props['exam'];
        $patient_model = $assessment_dto->patient_model;
        $new_assessment_exam = [];
        foreach ($assessment_exam as $key => &$form) {
            if ($key == 'body_form'){
                $sex = Str::lower($patient_model->prop_people['sex'] ?? 'male');
                $key = $sex.'_body_form';
            }
            if ($key == 'muscle_form'){
                $sex = Str::lower($patient_model->prop_people['sex'] ?? 'male');
                $key = $sex.'_muscle_form';
            }
            foreach ($form['data'] as &$anatomy_form) {
                $anatomy_model = $this->AnatomyModel()->findOrFail($anatomy_form['anatomy_id']);
                $anatomy_form['anatomy'] = $anatomy_model->toViewApiOnlies('id','name');
            }
            $new_assessment_exam[$key] = $form;
        }
        $assessment_exam = $new_assessment_exam;
        $this->prepareStoreAssessment($assessment_dto);
        $this->assessment_model->save();
        return $this->assessment_model;
    }

    // public function addPatientPhysicalExamination(?array $attributes = null): Model
    // {
    //     $attributes['patient_id']     = static::$__patient->getKey();
    //     $attributes['reference_id']   = $this->assessment_model->getKey();
    //     $attributes['reference_type'] = $this->assessment_model->morph;

    //     $patient_physical_examination_schema = $this->schemaContract('patient_physical_examination');
    //     return $patient_physical_examination_schema->prepareStorePatientPhysicalExamination($attributes);
    // }
}
