<?php

namespace App\Repositories\Country;


use App\Country;

class EloquentCountry implements CountryRepository
{

    /**
     * Create $key => $value array for all available countries.
     *
     * @param string $column
     * @param string $key
     * @return mixed
     */
    public function lists($column = 'name', $key = 'id')
    {
        return Country::orderBy('name')->pluck($column, $key);
    }

    /**
     * Get all available countries.
     * @return mixed
     */
    public function all()
    {
        return Country::all();
    }
}