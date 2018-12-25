<?php

namespace App;

use App\Support\Authorization\AuthorizationRoleTrait;

class Role extends BaseModel
{
    use AuthorizationRoleTrait;

    protected $table = 'roles';

    protected $casts = ['removable' => 'boolean'];

    protected $fillable = ['name', 'display_name', 'description'];

    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
