<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LoggerServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

		$this->app->singleton('RequestLogger', function() {
            return new Logger('DHL-Track', [$this->getMonologHandlerRequest()]);
        });
		
		$this->app->singleton('ErrorLogger', function() {
            return new Logger('DHL-Track', [$this->getMonologErrorHandler()]);
        });
		
    }
	
	protected function getMonologHandlerRequest()
    {
        return (new StreamHandler(storage_path('logs/xml_service.log'), Logger::DEBUG))
            ->setFormatter(new LineFormatter(null, null, null, true));
    }
	
	protected function getMonologErrorHandler()
    {
        return (new StreamHandler(storage_path('logs/error.log'), Logger::DEBUG))
            ->setFormatter(new LineFormatter(null, null, null, true));
    }
}