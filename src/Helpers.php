<?php

namespace Merlinpanda\Rbac;

class Helpers
{
    public static function getRoleWeights(int $weight = 0, $move = 1 , $data = [])
    {
        if ($weight <= 0) {
            return $data;
        }

        if (($weight & ($weight - 1)) == 0) {
            // 是2的幂次方
            return $data + [ $weight ];
        } else {
            $_2_power = (( $weight >> ($move - 1) ) & 1) << ($move - 1);
            if ($_2_power > 0) {
                $data[] = $_2_power;
            }

            return self::getRoleWeights($weight >> $move << $move, $move + 1, $data);
        }
    }
}
