<?php

namespace App\ServiceProviders;

use Illuminate\Support\ServiceProvider;
use App\Clients\OpenAiClient;

class ClientsServiceProvider extends ServiceProvider {

    public function boot() {

        $this->app->singleton(OpenAiClient::class, function() {
            return new OpenAiClient(env("OPEN_AI_API_KEY"));
        });

    }

}