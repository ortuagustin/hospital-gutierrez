<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;
    use AuthorizesRequests { resourceAbilityMap as resourceAbilityMapTrait; }

    /**
     * @inheritDoc
     */
    protected function resourceAbilityMap()
    {
        // this will make the index action of controllers use the policy method "view" for authorizations
        // based on https://github.com/laravel/internals/issues/772#issuecomment-327643505
        return array_merge($this->resourceAbilityMapTrait(), ['index' => 'view']);
    }
}
