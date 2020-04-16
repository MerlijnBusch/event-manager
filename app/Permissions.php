<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permissions extends Model {

    public const __ADMIN__ = 'Admin';

    public const __READ_ROLE__ = 'read_role';
    public const __WRITE_ROLE__ = 'write_role';

    public const __READ_CV__ = 'read_cv';
    public const __WRITE_CV__ = 'write_cv';

}
