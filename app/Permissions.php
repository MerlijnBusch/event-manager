<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

class Permissions extends Model {

    public function getAllPermissions() {
        try {
            $reflectionClass = new ReflectionClass($this);
            return $reflectionClass->getConstants();
        } catch (\ReflectionException $e) {
            abort(500, "Internal Server Error");
        }
    }

    public const __ADMIN__ = 'Admin';

    public const __READ_ROLE__ = 'read_role';
    public const __WRITE_ROLE__ = 'write_role';

    public const __READ_CV__ = 'read_cv';
    public const __WRITE_CV__ = 'write_cv';

}
