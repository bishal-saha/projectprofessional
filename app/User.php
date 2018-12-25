<?php

namespace App;

use App\Presenters\UserPresenter;
use App\Services\Logging\UserActivity\Activity;
use App\Support\Authorization\AuthorizationUserTrait;
use App\Support\Enum\UserStatus;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Route;
use Laracasts\Presenter\PresentableTrait;
use Webpatser\Uuid\Uuid;

class User extends Authenticatable
{
    use PresentableTrait,
        AuthorizationUserTrait,
        Notifiable;


    protected $presenter = UserPresenter::class;

    protected $table = 'users';

	protected $dates = ['last_login', 'birthday', 'created_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'first_name', 'last_name', 'phone', 'email', 'last_login', 'confirmation_token', 'status', 'remember_token', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	/**
	 *  Setup model event hooks
	 */
	public static function boot()
	{
		parent::boot();

		Route::bind('user', function ($value) {
			return User::where('uuid', $value)->first() ?? abort(404);
		});

		self::creating(function ($model) {
			$model->uuid = (string) Uuid::generate(4);
		});
	}

	/**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName()
	{
		return 'uuid';
	}

    /**
     * Always encrypt password when it is updated.
     *
     * @param $value
     * @return string
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function isUnconfirmed()
    {
        return $this->status == UserStatus::UNCONFIRMED;
    }

    public function isActive()
    {
        return $this->status == UserStatus::ACTIVE;
    }

    public function isBanned()
    {
        return $this->status == UserStatus::BANNED;
    }

    public function profile()
	{
		return $this->hasOne(UserProfile::class, 'user_id');
	}

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'user_id');
    }

	public function gravatar()
	{
		$hash = hash('md5', strtolower(trim($this->attributes['email'])));

		return sprintf("https://www.gravatar.com/avatar/%s?size=150", $hash);
	}

	public function role()
	{
		return $this->belongsTo(Role::class, 'role_id');
	}
}
