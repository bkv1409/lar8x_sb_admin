<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Common;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class AdminActivityLogController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:activity-log-list', ['only' => ['index']]);
    }

    public function index(Request $request)
    {
        $title = 'Activity Logs';
        $query = Activity::query()->latest();
        $subject = $request->subject;
        $causer = $request->causer;
        $description = $request->description;
        if ($subject) {
            $query->where('subject_type', 'like', "%$subject%");
        }
        if ($description) {
            $query->where('description', 'like', "%$description%");
        }
        if ($causer) {
            $query->whereHas('causer', function ($query) use ($causer) {
                $query->where('name', 'like', "%$causer%");
            });
        }
        $combineData = Common::addTimeRangeCond($query, $request, false);
//        $query->dd();
        $data = $query->paginate(config('constants.PAGINATION.BACKEND'));
        return view('admin.activity-log.index',
            array_merge(compact('title', 'data', 'subject', 'causer', 'description'), $combineData)
        );
    }
}
