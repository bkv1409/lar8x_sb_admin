<?php

namespace App\Models;


use Spatie\Activitylog\Traits\LogsActivity;

class Role extends \Spatie\Permission\Models\Role
{
    use LogsActivity;

    protected static $logAttributes = ['id', 'name', 'guard_name'];

    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;
}
