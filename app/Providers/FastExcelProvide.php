<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Service\Upload;

class FastExcelProvide extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Upload::class, function($app){
			return new Upload();
		});
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('upload-template', function($view){
		
			$label = 'Choose your EXEL/CSV file';
			$upload = 'Upload';
			return $view->with(['label'=>$label,'upload'=>$upload]);
		});
		 
    }
}
