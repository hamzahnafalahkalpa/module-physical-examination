<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Hanafalah\ModuleAnatomy\Models\Anatomy;
use Hanafalah\ModulePatient\Models\Patient\Patient;
use Hanafalah\ModulePhysicalExamination\Models\PatientPhysicalExamination;

return new class extends Migration
{
    use Hanafalah\LaravelSupport\Concerns\NowYouSeeMe;

    private $__table;

    public function __construct()
    {
        $this->__table = app(config('database.models.PatientPhysicalExamination', PatientPhysicalExamination::class));
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        $table_name = $this->__table->getTable();
        if (!$this->isTableExists()) {
            Schema::create($table_name, function (Blueprint $table) {
                $patient = app(config('database.models.Patient', Patient::class));
                $anatomy = app(config('database.models.Anatomy', Anatomy::class));

                $table->ulid('id')->primary();
                $table->string('condition')->nullable(false);

                $table->foreignIdFor($anatomy::class)->nullable(false)
                    ->index()->constrained()->cascadeOnUpdate()
                    ->cascadeOnDelete();

                $table->foreignIdFor($patient::class)->nullable(false)
                    ->index()->constrained()->cascadeOnUpdate()
                    ->cascadeOnDelete();

                $table->string('reference_type', 50)->nullable(false);
                $table->string('reference_id', 36)->nullable(false);

                $table->json('props')->nullable();
                $table->timestamps();
                $table->softDeletes();

                $table->index(['reference_type', 'reference_id'], 'ppe_ref');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->__table->getTable());
    }
};
