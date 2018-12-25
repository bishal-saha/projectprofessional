<?php

namespace App\Providers;

use App\Repositories\Activity\ActivityRepository;
use App\Repositories\Activity\EloquentActivity;
use App\Repositories\Country\CountryRepository;
use App\Repositories\Country\EloquentCountry;
use App\Repositories\Page\EloquentPage;
use App\Repositories\Page\PageRepository;
use App\Repositories\Permission\EloquentPermission;
use App\Repositories\Permission\PermissionRepository;
use App\Repositories\Role\EloquentRole;
use App\Repositories\Role\RoleRepository;
use App\Repositories\Session\DbSession;
use App\Repositories\Session\SessionRepository;
use App\Repositories\User\EloquentUser;
use App\Repositories\User\UserRepository;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		Carbon::setLocale(config('app.locale'));
		config(['app.name' => Setting('app_name')]);
        \Illuminate\Database\Schema\Builder::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
		$this->app->singleton(UserRepository::class, EloquentUser::class);
		$this->app->singleton(ActivityRepository::class, EloquentActivity::class);
		$this->app->singleton(RoleRepository::class, EloquentRole::class);
		$this->app->singleton(PermissionRepository::class, EloquentPermission::class);
		$this->app->singleton(SessionRepository::class, DbSession::class);
		$this->app->singleton(CountryRepository::class, EloquentCountry::class);
		$this->app->singleton(PageRepository::class, EloquentPage::class);

		if ($this->app->environment() !== 'production') {
			$this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
		}
    }
}
