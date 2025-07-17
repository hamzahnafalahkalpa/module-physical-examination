<?php

declare(strict_types=1);

namespace Hanafalah\ModulePhysicalExamination\Providers;

use Illuminate\Support\ServiceProvider;
use Hanafalah\ModulePhysicalExamination\Commands as Commands;

class CommandServiceProvider extends ServiceProvider
{
    private $commands = [
        Commands\InstallMakeCommand::class
    ];


    public function register()
    {
        $this->commands($this->commands);
    }

    public function provides()
    {
        return $this->commands;
    }
}
