<?php

namespace Merlinpanda\Rbac;

use Illuminate\Support\Str;

class Helpers
{
    public static function getRoleWeights(int $weight = 0, $move = 1 , $data = [])
    {
        if ($weight <= 0) {
            return $data;
        }

        if (($weight & ($weight - 1)) == 0) {
            // 是2的幂次方
            return array_merge($data, [ $weight ]);
        } else {
            $_2_power = (( $weight >> ($move - 1) ) & 1) << ($move - 1);
            if ($_2_power > 0) {
                $data[] = $_2_power;
            }

            return self::getRoleWeights($weight >> $move << $move, $move + 1, $data);
        }
    }

    /**
     * 判断路由是否在某些路由规则中
     *
     * @param $route_name
     * @param array $pattern
     * @return bool
     */
    public static function routeIn($route_name, array $routes = []): bool
    {
        $route_patterns = array_map(function ($route) {
            return self::stringToRoutePattern($route);
        }, $routes);

        $matched = array_filter($route_patterns, function ($pattern) use ($route_name) {
            preg_match($pattern, $route_name, $matches);

            return count($matches) > 0;
        });

        return count($matched) > 0;
    }

    /**
     * 将字符串处理成路由正则表达式
     *
     * @param string $string
     * @return string
     */
    public static function stringToRoutePattern(string $string): string
    {
        if (Str::startsWith($string, "/") && Str::endsWith($string, "/")) {
            return $string;
        }

        $string = str_replace(".*", "\..*", $string);
        $string = str_replace("/", "\/", $string);

        return sprintf("/%s/", $string);
    }
}
