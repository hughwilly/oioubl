<?php

namespace HughWilly\Oioubl\Providers;

use Illuminate\Support\ServiceProvider;

class OioublServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/oioubl.php', 'oioubl');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'oioubl');
    }
}
