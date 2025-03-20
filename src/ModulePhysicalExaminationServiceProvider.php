<?php

namespace Zahzah\ModulePhysicalExamination;

use Zahzah\LaravelSupport\Providers\BaseServiceProvider;

class ModulePhysicalExaminationServiceProvider extends BaseServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerMainClass(ModulePhysicalExamination::class)
             ->registerCommandService(Providers\CommandServiceProvider::class)
             ->registers([           
                '*',
                'Services'  => function(){
                    $this->binds([
                        Contracts\ModulePhysicalExamination::class  => ModulePhysicalExamination::class,
                        Contracts\PhysicalExamination::class        => Schemas\PhysicalExamination::class,
                        Contracts\PatientPhysicalExamination::class => Schemas\PatientPhysicalExamination::class
                    ]);
                }
             ]);
        $this->setupExaminationLists();
    }

    private function setupExaminationLists(): self{
        $examination_lists = config('database.examinations', []);
        $lists = config('module-physical-examination.examinations', []);
        $examination_lists = array_merge($examination_lists, $lists);
        config(['database.examinations' => $examination_lists]);
        return $this;
    }

    protected function dir(): string{
        return __DIR__.'/';
    }

    protected function migrationPath(string $path = ''): string{
        return database_path($path);
    }
}
