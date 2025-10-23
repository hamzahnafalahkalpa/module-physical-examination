<?php

namespace Hanafalah\ModulePhysicalExamination\Models;

use Hanafalah\ModuleExamination\Models\Examination\Assessment\Assessment;
use Illuminate\Support\Str;

class PhysicalExamination extends Assessment
{
    protected $table = 'assessments';
    public $specific = [
        'female_body_form','female_muscle_form','male_body_form','male_muscle_form'
    ];


    public function getExams(mixed $default = null,? array $vars = null): array{
        $result = [];
        $specifics = $this->specific;
        foreach ($specifics as $var) {
            if (isset(request()->sex) && in_array(request()->sex,['female','male'])){
                if (!Str::contains($var,request()->sex)) continue;
                $default = $this->getDefaultForm($var);
                $var = Str::after($var,request()->sex.'_');
            }else{
                $default = $this->getDefaultForm($var);
            }
            $result[$var] = $default;
        }
        return ['exam' => $result];
    }

    private function getDefaultForm(string $specific){
        switch ($specific) {
            default:
                return [
                    "asset_url" => physical_asset_url('/assets/'.$specific.'.webp'),
                    'label' => 'Head to Toe',
                    'morph' => 'HeadToToe',
                    'data' => []
                ];
            break;
        }
    }
}