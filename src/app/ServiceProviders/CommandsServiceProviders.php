<?php

namespace App\ServiceProviders;

use App\Commands\ValidateBook;
use Illuminate\Support\ServiceProvider;

class CommandsServiceProviders extends ServiceProvider {

    public function boot() {

        $this->commands(ValidateBook::class);

    }

}