<?php

namespace App\Services;
use Illuminate\Support\Facades\Log;

/**
 * Description of Logs
 *
 * @author Administrator
 */
class LogService
{


    /**
     * @param $user
     * @param $message
     * @param  null  $performModel
     * @param  null  $attributes
     * @param  null  $extras
     * @return \Spatie\Activitylog\Contracts\Activity|void
     */
    public static function logActivity($user, $message, $performModel = null,  $attributes = null, $extras = null)
    {
        $activity = activity()->causedBy($user);
        if (!empty($performModel)) $activity->performedOn($performModel);
        if (!empty($attributes)) $activity->withProperties(compact('attributes'));
        if (!empty($extras)) $activity->withProperties(compact('extras'));
        return $activity->log($message);
    }
}
