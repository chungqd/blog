<?php 
namespace App\Modules;
use Illuminate\Support\Facades\Auth;
/**
* ServiceProvider
*/
class ModulesServiceProvider extends \Illuminate\Support\ServiceProvider
{
    
    public function boot()
    {
        $modules = config("module.modules");
 
        while (list(,$module) = each($modules)) {

            // Load routes
            if(file_exists(__DIR__.'/'.$module.'/routes.php')) {
                include __DIR__.'/'.$module.'/routes.php';
            }

            // Load views
            if(is_dir(__DIR__.'/'.$module.'/Views')) {
                $this->loadViewsFrom(__DIR__.'/'.$module.'/Views', $module);
            }
        }

    }

    public function register() {}

}
