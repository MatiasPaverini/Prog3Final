<?php

namespace Utils;

class UserTypes
{

    const ADMIN = [0, "admin"];
    const USER = [1, "user"];
 
    const TYPES = [self::ADMIN, self::USER];

    public function isTypeString(string $type) :bool {
        foreach (self::TYPES as $type => $value) {
            if($value[1] == $type) {
                return true;
            }
        }
        return false;
    }

    public function isTypeInt(string $type) :bool {
        foreach (self::TYPES as $type => $value) {
            if($value[0] == $type) {
                return true;
            }
        }
        return false;
    }

    public function convertToInt(string $strType) :int {
        foreach (self::TYPES as $type => $value) {
            if($value[1] == trim($strType)) {
                return $value[0];
            }

        }
        return -1;
    }

    public function convertToString(int $type) {
        foreach (self::TYPES as $type => $value) {
            if($value[0] == $type) {
                return $value[1];
            }
        }
        return null;
    }
}

?>