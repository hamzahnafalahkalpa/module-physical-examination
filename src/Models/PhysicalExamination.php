<?php

namespace Hanafalah\ModulePhysicalExamination\Models;

use Hanafalah\ModuleExamination\Models\Examination\Assessment\Assessment;
use Hanafalah\ModulePhysicalExamination\Resources\PhysicalExamination\{
    ViewPhysicalExamination, ShowPhysicalExamination
};
use Illuminate\Support\Str;

class PhysicalExamination extends Assessment
{
    protected $table = 'assessments';
    public $specific = [
        'female_body_form','female_muscle_form','male_body_form','male_muscle_form',
        'child_form','baby_form','odontogram'
    ];

    public function getExams(mixed $default = null,? array $vars = null): array{
        $result = [];
        $specifics = $this->specific;
        foreach ($specifics as $var) {
            $is_request_sex = isset(request()->sex);
            $is_request_patient_id = isset(request()->patient_id);
            if ($is_request_patient_id || $is_request_sex){
                if ($is_request_patient_id){
                    $patient = $this->PatientModel()->findOrFail(request()->patient_id);
                    request()->merge([
                        'sex' => $patient->prop_people['sex']
                    ]);
                    $patient_segment = $this->patientSegment($patient->prop_people['dob']);
                    $is_bayi_balita = false;
                    $is_anak_anak = false;
                    $is_request_sex = false;
                    if ($patient_segment == 'bayi dan balita'){
                        $is_bayi_balita = true;
                    }   
                    if ($patient_segment == 'anak-anak'){
                        $is_anak_anak = true;
                    }
                    if (!$is_bayi_balita && !$is_anak_anak && $var !== 'odontogram'){
                        $is_request_sex = true;                        
                    }
                }
                if ($var == 'odontogram'){
                    $default = $this->getDefaultForm($var);
                }else{
                    if ($is_request_sex){
                        if (!Str::contains($var,request()->sex)) continue;
                        $default = $this->getDefaultForm($var);
                        $var = Str::after($var,request()->sex.'_');
                    }
                    if ($is_bayi_balita || $is_anak_anak){
                        if ($is_bayi_balita && !Str::contains($var,'baby')) continue;
                        if ($is_anak_anak && !Str::contains($var,'child')) continue;
                        $default = $this->getDefaultForm($var);
                    }                
                }
            }else{
                $default = $this->getDefaultForm($var);
            }
            $result[$var] = $default;
        }
        return ['exam' => $result];
    }

    private function getDefaultForm(string $specific){
        switch ($specific) {
            case 'female_body_form':
            case 'male_body_form':
            case 'child_form':
            case 'baby_form':
                return [
                    "asset_url" => physical_asset_url('/assets/'.$specific.'.webp'),
                    'label' => 'Head to Toe',
                    'morph' => 'HeadToToe',
                    'data' => []
                ];
            break;
            case 'female_muscle_form':
            case 'male_muscle_form':
                return [
                    "asset_url" => physical_asset_url('/assets/'.$specific.'.webp'),
                    'label' => 'Head to Toe (Muskular)',
                    'morph' => 'HeadToToe',
                    'data' => []
                ];
            break;
            case 'odontogram':
                return [
                    "asset_url" => physical_asset_url('/assets/'.'odontogram.svg'),
                    'label' => 'Odontogram',
                    'morph' => 'Odontogram',
                    'data' => []
                ];
            break;
        }
    }

    public function getViewResource(){
        return ViewPhysicalExamination::class;
    }

    public function getShowResource(){
        return ShowPhysicalExamination::class;
    }
}