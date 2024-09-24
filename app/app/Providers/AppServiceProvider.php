<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Debugbar', \Barryvdh\Debugbar\Facades\Debugbar::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        $this->defineCustomBladeDirective();
    }

    private function defineCustomBladeDirective(){
        Blade::directive('convert', function ($money) {
            if(!is_numeric($money)){
                return $money;
            }
            
            $currency = env("CURRENCY_FORMAT", '$');
            $formatedNumber = number_format($money, 2);
            return "<?php echo '$' . $formatedNumber; ?>";
        });
    }
}
