<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class AuthService
{
    public static function isValid($route)
    {
        $user = auth()->user();
        $role = $user->role;

        // Check if the user is authenticated and their password has been changed
        $routes = [];

        $sidebar = collect(config('sidebar.menus'));
        foreach($sidebar as $k => $value) {
            if (isset($value['route']) && strlen($value['route']) > 0 && in_array($role, $value['roles'] ?? [])) {
                // untuk route parent menu item
                $routes[] = $value['route'];
            }

            if (isset($value['routes'])) {
                foreach($value['routes'] ?? [] as $key2 => $value2) {
                    if (in_array($role, $value2)) {
                        $routes[] = $key2;
                    }
                }
            }

            if (isset($value['children'])) {
                foreach($value['children'] ?? [] as $k2 => $value2) {
                    if (isset($value2['route']) && strlen($value2['route']) > 0 && in_array($role, $value2['roles'] ?? [])) {
                        // untuk route parent menu item
                        $routes[] = $value2['route'];
                    }

                    if (isset($value2['routes'])) {
                        foreach($value2['routes'] ?? [] as $key3 => $value3) {
                            if (in_array($role, $value3)) {
                                $routes[] = $key3;
                            }
                        }
                    }
                }
            }
        }


        $all = collect($routes)->filter(function ($name) {
            return str_contains($name, '*');
        });

        $all = $all->map(function($string){
            $trimmed = (substr($string, -1) === '*') ? substr($string, 0, -1) : $string;
            return $trimmed;
        });



        $find = collect($all)->filter(function ($name) use($route) {
            return str_starts_with($route, $name);
        })->count() > 0 ? true : false;



        // dd($routes);

        $check_route = in_array($route, $routes) || $find;

        return $check_route;
    }

}