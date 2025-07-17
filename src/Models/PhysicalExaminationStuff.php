<?php

namespace Hanafalah\ModulePhysicalExamination\Models;

use Hanafalah\ModuleExamination\Models\ExaminationStuff;
use Hanafalah\ModulePhysicalExamination\Resources\PhysicalExaminationStuff\{
    ViewPhysicalExaminationStuff,
    ShowPhysicalExaminationStuff
};

class PhysicalExaminationStuff extends ExaminationStuff
{
    protected $table = "examination_stuffs";

    public function viewUsingRelation(): array{
        return [];
    }

    public function showUsingRelation(): array{
        return [];
    }

    public function getViewResource(){
        return ViewPhysicalExaminationStuff::class;
    }

    public function getShowResource(){
        return ShowPhysicalExaminationStuff::class;
    }
}
