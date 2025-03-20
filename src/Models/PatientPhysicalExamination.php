<?php

namespace Zahzah\ModulePhysicalExamination\Models;

use Gii\ModuleExamination\Models\Examination;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Zahzah\LaravelHasProps\Concerns\HasProps;
use Zahzah\ModulePhysicalExamination\Resources\PatientPhysicalExamination\{
    ViewPatientPhysicalExamination, ShowPatientPhysicalExamination
};
use Zahzah\LaravelSupport\Models\BaseModel;

class PatientPhysicalExamination extends Examination {
    use HasUlids, SoftDeletes, HasProps;

    public $incrementing  = false;
    protected $keyType    = 'string';
    protected $primaryKey = 'id';
    protected $list = [
        'id', 'reference_type', 'reference_id', 
        'anatomy_id', 'condition', 'patient_id', 'props'
    ];

    protected $show = [
        'examination_summary_id', 'patient_summary_id'
    ];

    protected $casts = [
        'condition' => 'string'
    ];

    public function toViewApi(){
        return new ViewPatientPhysicalExamination($this);
    }

    public function toShowApi(){
        return new ShowPatientPhysicalExamination($this);
    }

    public function anatomy(){
        return $this->belongsToModel('Anatomy');
    }

    public function patient(){
        return $this->belongsToModel('Patient');
    }

    public function reference(){
        return $this->morphTo();
    }
}  
