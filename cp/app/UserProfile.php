<?php

namespace App;

use App\Presenters\UserProfilePresenter;
use Illuminate\Notifications\Notifiable;
use Laracasts\Presenter\PresentableTrait;

class UserProfile extends BaseModel
{
	use PresentableTrait, Notifiable;

	protected $presenter = UserProfilePresenter::class;

    protected $table = 'user_profile';

	protected $dates = ['birthday'];

	protected $fillable = [
		'avatar', 'address', 'country_id', 'birthday',
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function setBirthdayAttribute($value)
	{
		$this->attributes['birthday'] = trim($value) ?: null;
	}
}
