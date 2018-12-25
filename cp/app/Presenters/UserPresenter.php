<?php
namespace App\Presenters;

use function GuzzleHttp\Psr7\str;
use Illuminate\Support\Str;
use Laracasts\Presenter\Presenter;
use App\Support\Enum\UserStatus;

class UserPresenter extends Presenter
{
	public function name()
    {
        return sprintf("%s %s", $this->entity->first_name, $this->entity->last_name);
    }

    public function nameOrEmail()
    {
        return trim($this->name()) ?: $this->entity->email;
    }

    public function lastLogin()
    {
        return $this->entity->last_login ? $this->entity->last_login->diffForHumans() : 'N/A';
    }

	public function avatar()
	{
		if (!isset($this->entity->profile->avatar)) {
			return url('images/profile.png');
		}

		return str::contains($this->entity->profile->avatar, ['http', 'gravatar'])
			? $this->entity->profile->avatar
			: url("uploads/users/{$this->entity->profile->avatar}");
	}

	public function birthday()
	{
		return $this->entity->profile->birthday
			? $this->entity->profile->birthday->format(config('app.date_format'))
			:'N/A';
	}

	public function fullAddress()
	{
		$address = '';
		$userProfile = $this->entity->profile;

		if ($userProfile->address) {
			$address .= $userProfile->address;
		}

		if ($userProfile->country_id) {
			$address .= $userProfile->address ? ", { $userProfile->country_name}" : $userProfile->counytry_name;
		}

		return $address ?: 'N/A';
	}

	/**
	 * Determine css class used for status labels
	 * inside the users table by checking user status.
	 *
	 * @return string
	 */
	public function userStatusBadge()
	{
		switch ($this->entity->status) {
			case UserStatus::ACTIVE:
				$badge = "<span class='badge badge-success' title='Active'>Active</span>";
				break;

			case UserStatus::BANNED:
				$badge = "<span class='badge badge-danger' title='Banned'>Banned</span>";
				break;

			default:
				$badge = "<span class='badge badge-warning' title='Inactive'>Inactive</span>";
		}

		return $badge;
	}
}