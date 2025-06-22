<?php

namespace Hanafalah\ModulePhysicalExamination\Contracts\Schemas;

use Hanafalah\ModulePhysicalExamination\Contracts\Data\PhysicalExaminationStuffData;
use Hanafalah\ModuleExamination\Contracts\Schemas\ExaminationStuff;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\ModulePhysicalExamination\Schemas\PhysicalExaminationStuff
 * @method mixed export(string $type)
 * @method self conditionals(mixed $conditionals)
 * @method array updatePhysicalExaminationStuff(?PhysicalExaminationStuffData $physical_examination_stuff_dto = null)
 * @method Model prepareUpdatePhysicalExaminationStuff(PhysicalExaminationStuffData $physical_examination_stuff_dto)
 * @method bool deletePhysicalExaminationStuff()
 * @method bool prepareDeletePhysicalExaminationStuff(? array $attributes = null)
 * @method mixed getPhysicalExaminationStuff()
 * @method ?Model prepareShowPhysicalExaminationStuff(?Model $model = null, ?array $attributes = null)
 * @method array showPhysicalExaminationStuff(?Model $model = null)
 * @method Collection prepareViewPhysicalExaminationStuffList()
 * @method array viewPhysicalExaminationStuffList()
 * @method LengthAwarePaginator prepareViewPhysicalExaminationStuffPaginate(PaginateData $paginate_dto)
 * @method array viewPhysicalExaminationStuffPaginate(?PaginateData $paginate_dto = null)
 * @method array storePhysicalExaminationStuff(?PhysicalExaminationStuffData $physical_examination_stuff_dto = null)
 * @method Collection prepareStoreMultiplePhysicalExaminationStuff(array $datas)
 * @method array storeMultiplePhysicalExaminationStuff(array $datas)
 */

interface PhysicalExaminationStuff extends ExaminationStuff
{
    public function prepareStorePhysicalExaminationStuff(PhysicalExaminationStuffData $physical_examination_stuff_dto): Model;
    public function physicalExaminationStuff(mixed $conditionals = null): Builder;
}