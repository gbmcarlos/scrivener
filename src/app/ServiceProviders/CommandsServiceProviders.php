<?php

namespace App\ServiceProviders;

use App\Commands\TransformBookContentCommand;
use Illuminate\Support\ServiceProvider;

class CommandsServiceProviders extends ServiceProvider {

    public function boot() {

        $this->commands(TransformBookContentCommand::class);

    }

}