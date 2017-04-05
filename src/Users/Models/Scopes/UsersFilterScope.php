<?php

namespace Myrtle\Core\Users\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class UsersFilterScope implements Scope
{
    protected $filters = ['biograph', 'roles'];

    public function apply(Builder $builder, Model $model)
	{
	    //return $this->applyFilters($builder);
	}

    public function extend(Builder $builder)
    {
        $builder->macro('filtered', function (Builder $builder) {
            return $this->applyFilters($builder);
        });
    }

    protected function getFilters()
    {
        return request()->only($this->filters);
    }

    public function applyFilters(Builder $builder)
    {
        collect($this->getFilters())->reject(function($value, $filter) {
            return empty($value);
        })->each(function($value, $filter) use (&$builder){
            $method = 'apply' . Str::ucfirst($filter) . 'Filter';
            $builder = $this->$method($value, $builder);
        });

        return $builder;
    }

    public function applyBiographFilter($value, Builder $builder)
    {
        collect($value)->filter(function($value, $key) {
            return $key === 'gender_id' || $key === 'marital_status_id';
        })->reject(function($value, $key) {
            return empty($value);
        })->each(function($value, $key) use (&$builder) {
            $builder->whereHas('biograph', function($query) use ($value, $key) {
                $query->where($key, $value);
            });
        });

        return $builder;
    }

    public function applyRolesFilter($value, Builder $builder)
    {
        collect($value)->reject(function($value, $key){
            return empty($value);
        })->each(function($value, $key) use (&$builder) {
            $builder->whereHas('roles', function($query) use ($value) {
                $query->where('id', $value);
            });
        });

        return $builder;
    }
}
