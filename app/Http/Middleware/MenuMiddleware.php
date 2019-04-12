<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;

class MenuMiddleware
{
    protected $arrNavigation = [];

    public function handle($request, Closure $next)
    {
        // Perform action
        $user = \Auth::user();
        $navigations = config('app.navigations');
        foreach ($navigations as $navigation) {
            $this->addMenu($navigation);
        }
        View::share('navigations', $this->arrNavigation);
        return $next($request);
    }

    protected function addMenu($navigation)
    {
        if (!$this->isMenuAllowed($navigation)) {
            return;
        }
       
        $this->arrNavigation[] = [
                'label' => $navigation['label'],
                'icon'  => $navigation['icon'],
                'route' => !empty($navigation['route']) ? $navigation['route'] : '#',
            ];
    }

    protected function isMenuAllowed($navigation)
    {
        $allowed   = true;
        $resource  = !empty($navigation['resource']) ? $navigation['resource'] : '';
        $privilege = !empty($navigation['privilege']) ? $navigation['privilege'] : '';
        if (!empty($resource) && !empty($privilege)) {
            $allowed = \Gate::allows('access', [$resource, $privilege]);
        }
      
        return $allowed;
    }
}