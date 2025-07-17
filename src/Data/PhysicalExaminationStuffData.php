<?php

namespace Hanafalah\ModulePhysicalExamination\Data;

use Hanafalah\ModuleExamination\Data\ExaminationStuffData;
use Hanafalah\ModulePhysicalExamination\Contracts\Data\PhysicalExaminationStuffData as DataPhysicalExaminationStuffData;

class PhysicalExaminationStuffData extends ExaminationStuffData implements DataPhysicalExaminationStuffData
{
    public static function before(array &$attributes){
        $attributes['flag'] ??= 'PhysicalExaminationStuff';
        parent::before($attributes);
    }
}