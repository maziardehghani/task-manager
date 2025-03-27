<?php

namespace App\Traits;

trait Searchable
{
    protected function scopeSearch($query, array $params): void
    {
        foreach ($params as $key => $value) {
            $query->filter($key, $value);
        }
    }

    public function scopeFilter($query, $methodName, $arguments)
    {
        if (method_exists($this, "filterBy$methodName")) {
            return call_user_func_array([$this, "filterBy$methodName"], [$query, $arguments]);
        }
    }
}
