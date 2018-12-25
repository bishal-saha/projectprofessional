<?php

namespace App\Providers;

use App\Page;
use App\Repositories\Page\PageRepository;
use App\Repositories\Role\RoleRepository;
use App\Repositories\Session\SessionRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RouteServiceProvider extends ServiceProvider
{
	/**
	 * This namespace is applied to the controller routes in your web routes file.
	 * In addition, it is set as the URL generator's root namespace.
	 * @var string
	 */
	protected $webNamespace = 'App\Http\Controllers\Web';

	/**
	 * This namespace is applied to the controller routes in your api routes file.
	 * @var string
	 */
	protected $apiNamespace = 'App\Http\Controllers\Api';

	/**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
		parent::boot();

		$this->bindUser();
		$this->bindRole();
		$this->bindSession();
		$this->bindPage();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
		if ($this->app['config']->get('auth.expose_api')) {
			$this->mapApiRoutes();
		}

		$this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->webNamespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->apiNamespace)
             ->group(base_path('routes/api.php'));
    }

	private function bindUser()
	{
		$this->bindUsingRepository('user', UserRepository::class);
	}

	private function bindRole()
	{
		$this->bindUsingRepository('role', RoleRepository::class);
	}

	private function bindSession()
	{
		$this->bindUsingRepository('session', SessionRepository::class);
	}

	private function bindPage()
	{
		$this->bindUsingRepository('slug', PageRepository::class);
	}

	private function bindUsingRepository($entity, $repository, $method = 'find')
	{
		Route::bind($entity, function ($value) use ($repository, $method) {
			if ($object = app($repository)->$method($value)) {
				return $object;
			}

			throw new NotFoundHttpException("Resource not found.");
		});
	}
}
