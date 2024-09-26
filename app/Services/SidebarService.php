<?php

namespace App\Services;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class SidebarService
{
    public static function isActive($menu)
    {
        $current_route = Route::currentRouteName();

        $is_active =  isset($menu['route']) ? Route::currentRouteName() == $menu['route'] : null;

        if ($is_active == true) return $is_active;

        if (isset($menu['children'])) {
            foreach($menu['children'] ?? [] as $k2 => $value2) {
                $is_active = self::isActiveSubmenu($value2);
                if ($is_active == true) return $is_active;
                
            }
        }

        return false;
    }


    public static function isActiveSubmenu($menu = [])
    {
        $current_route = Route::currentRouteName();
  
        $route = $menu['route'] ?? null;

        $routes = [];

        if ($route != null) {
            $routes[] = $menu['route'];
        }
    

        if (isset($menu['routes'])) {
            foreach($menu['routes'] ?? [] as $key3 => $value3) {
                $routes[] = $key3;
            }
        }

        $all = collect($routes)->filter(function ($name) {
            return str_contains($name, '*');
        });

        $all = $all->map(function($string){
            $trimmed = (substr($string, -1) === '*') ? substr($string, 0, -1) : $string;
            return $trimmed;
        });



        $find = collect($all)->filter(function ($name) use($current_route) {
            return str_starts_with($current_route, $name);
        })->count() > 0 ? true : false;


        // dd($routes);

        $check_route = in_array($current_route, $routes) || $find;

        return $check_route;
        

    }

}