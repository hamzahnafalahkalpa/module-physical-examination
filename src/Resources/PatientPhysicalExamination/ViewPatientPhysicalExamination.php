<?php

namespace Zahzah\ModulePhysicalExamination\Resources\PatientPhysicalExamination;

use Zahzah\LaravelSupport\Resources\ApiResource;

class ViewPatientPhysicalExamination extends ApiResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $resquest
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray(\Illuminate\Http\Request $request) : array{
      $arr = [
        'id'             => $this->id,
        'reference_type' => $this->reference_type,
        'reference'      => $this->relationValidation('reference',function(){
          return $this->reference->toViewApi();
        }),        
        'anatomy'        => $this->relationValidation('anatomy',function(){
          return $this->anatomy->toViewApi();
        }),
        'condition'      => $this->condition,
        'patient'        => $this->relationValidation('patient',function(){
          return $this->patient->toViewApi();
        })
      ];
      
      return $arr;
  }
}