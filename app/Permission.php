<?php

namespace App;


class Permission extends BaseModel
{
    protected $table = 'permissions';

    protected $fillable = ['name', 'display_name', 'description'];

    protected $casts = ['removable' => 'boolean'];
}
