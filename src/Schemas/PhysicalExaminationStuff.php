<?php

namespace Hanafalah\ModulePhysicalExamination\Schemas;

use Hanafalah\ModuleExamination\Schemas\ExaminationStuff;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModulePhysicalExamination\Contracts\Schemas\PhysicalExaminationStuff as ContractsPhysicalExaminationStuff;
use Hanafalah\ModulePhysicalExamination\Contracts\Data\PhysicalExaminationStuffData;
use Illuminate\Database\Eloquent\Builder;

class PhysicalExaminationStuff extends ExaminationStuff implements ContractsPhysicalExaminationStuff
{
    protected string $__entity = 'PhysicalExaminationStuff';
    public static $physical_examination_stuff_model;
    //protected mixed $__order_by_created_at = false; //asc, desc, false

    protected array $__cache = [
        'index' => [
            'name'     => 'physical_examination_stuff',
            'tags'     => ['physical_examination_stuff', 'physical_examination_stuff-index'],
            'duration' => 24 * 60
        ]
    ];

    public function prepareStorePhysicalExaminationStuff(PhysicalExaminationStuffData $physical_examination_stuff_dto): Model{
        $physical_examination_stuff = $this->prepareStoreExaminationStuff($physical_examination_stuff_dto);       
        return static::$physical_examination_stuff_model = $physical_examination_stuff;
    }

    public function physicalExaminationStuff(mixed $conditionals = null): Builder{
        return $this->unicode($conditionals);
    }
}