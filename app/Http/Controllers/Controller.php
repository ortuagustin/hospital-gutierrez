<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;
    use AuthorizesRequests {
        resourceAbilityMap as resourceAbilityMapTrait;
        resourceMethodsWithoutModels as resourceMethodsWithoutModelsTrait; }

    /**
     * @inheritDoc
     */
    protected function resourceAbilityMap()
    {
        // this will make the index action of controllers use the policy method "view" for authorizations
        // based on https://github.com/laravel/internals/issues/772#issuecomment-327643505
        return array_merge($this->resourceAbilityMapTrait(), ['index' => 'view']);
    }

    /**
     * @inheritDoc
     */
    protected function resourceMethodsWithoutModels()
    {
        // in \App\Policies\ModelPolicy it's defined that the update action does not require the model instance
        // if this method weren't overriden, then controllers MUST add the model parameter in the method definition
        // this allows to only have the Request parameter in controllers
        return array_merge($this->resourceMethodsWithoutModelsTrait(), ['update']);
    }

    /**
     * Flashes to the request session
     *
     * @param mixed $value
     * @param string $key
     * @return $this
     */
    protected function flash($value, $key = 'flash')
    {
        request()->session()->flash($key, $value);

        return $this;
    }
}
