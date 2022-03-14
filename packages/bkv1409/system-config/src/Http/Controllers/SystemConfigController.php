<?php
namespace Bkv1409\SystemConfig\Http\Controllers;

use App\Helpers\Common;
use App\Http\Controllers\Controller;
use Bkv1409\SystemConfig\Models\SystemConfig;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SystemConfigController extends Controller
{
    public function __construct()
    {
//        $this->middleware('permission:system-config-list|system-config-create|system-config-edit|system-config-delete', ['only' => ['index', 'edit']]);
//        $this->middleware('permission:system-config-create', ['only' => ['create', 'save']]);
//        $this->middleware('permission:system-config-edit', ['only' => ['edit', 'save', 'changeStatus']]);
//        $this->middleware('permission:system-config-delete', ['only' => ['destroy']]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory
     */
    public function index(Request $request) {
        $title = 'Cấu hình hệ thống';
//        $config = Config::get();
        $name = $request->input('search_name', '');

        $query = SystemConfig::query()->orderBy('created_at', 'DESC');
        // Tìm kiếm theo điều kiện
        if ($name) {
            $query->where(function($query) use ($name) {
                $query->where('name', 'LIKE', "%" . $name . "%");
                $query->orWhere('display_name', 'LIKE', "%" . $name . "%");
            });
        }

        // Tìm kiếm theo ngày tạo
        $combineData = Common::addTimeRangeCond($query, $request, false, 'date', false);
//        dd($query->toSql(), $query->getBindings());
        $systemConfigs = $query->paginate(config('constants.PAGINATION.BACKEND'));
        return view('system-config::index', array_merge($combineData, compact(
            'title',
            'systemConfigs',
            'name'
        )));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function save(Request $request, $id = null) {
        $isFileType = $request->input('type', '') === SystemConfig::$SYSTEM_CONFIG_TYPES['FILE'];

        if (empty($id)) { // create new
            $systemConfig = new SystemConfig();
            $successLink = route('admin.system-configs.index');
            $failedLink = route('admin.system-configs.create');
            $validator = Validator::make($request->all(), [
//                'name' => 'bail|required|unique:system_configs|max:255',
                'name' => 'bail|required|max:255',
            ]);
            if ($validator->fails()) {
                return redirect($failedLink)->withErrors($validator)->withInput()
                    ->with('failed', 'Có lỗi trong quá trình cập nhật/ tạo mới cấu hình hệ thống! ' .
                        'Trường Key không được để trống hoặc trùng lặp.');
            }
        } else {
            $systemConfig = SystemConfig::find($id);
//            $successLink = route('admin.system-configs.edit', $id);
            $successLink = route('admin.system-configs.index');
            $failedLink = route('admin.system-configs.edit', $id);
            if (!$systemConfig) {
                return redirect($failedLink)
                    ->with('failed', 'Có lỗi trong quá trình cập nhật/ tạo mới cấu hình hệ thống!');
            }
        }

        try {
            if ($isFileType) {
                $validator = Validator::make($request->all(), [
                    'value' => array_merge($systemConfig->exists === true ? [] : ['required'], [
                        Common::documentMIMETypePattern(),
                        'max:5120'
                    ])
                ]);
                if ($validator->fails()) {
                    return redirect($failedLink)->withErrors($validator)->withInput()
                        ->with('failed', 'Có lỗi trong quá trình cập nhật/ tạo mới cấu hình hệ thống! '
                            . 'File upload không có hoặc sai định dạng cơ bản. '
                            . 'File upload phải có dạng ảnh (JPG, PNG,...), excel (XLS, XLSX,...), Văn bản (DOC, DOCX, PDF,...)'
                            . ' Và có dung lượng không quá 5MB');
                }
            }

            $this->updateSystemConfig($systemConfig, $request, $isFileType);
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());
            return redirect($failedLink)
                ->with('failed', 'Có lỗi trong quá trình cập nhật/ tạo mới cấu hình hệ thống!');
        }
        return redirect($successLink)
            ->with('success', (empty($id) ? 'Tạo mới' : 'Sửa') . ' cấu hình hệ thống ' . (empty($id) ? '' : "$id ") .'thành công');
    }


    /**
     * @param $id
     * @param  Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id, Request $request)
    {
        $title = 'Chỉnh sửa Cấu hình hệ thống';
        $systemConfig = SystemConfig::find($id);
        return view('system-config::edit', compact('systemConfig', 'title'));
    }

    /**
     * @param $id
     * @param  Request  $request
     * @return \Illuminate\Contracts\View\Factory
     */
    public function show($id, Request $request)
    {
        $title = 'Chi tiết Cấu hình hệ thống';
        $systemConfig = SystemConfig::find($id);
        return view('system-config::show', compact('systemConfig', 'title'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        // add forget cache before delete
        $systemConfig = SystemConfig::find($id);
        $systemConfig->forgetMe();
        $systemConfig->delete();
        return redirect(route('admin.system-configs.index'))->with('success', 'Xóa cấu hình hệ thống thành công');
    }

    /**
     * @param $id
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function changeStatus($id, Request $request)
    {
        $systemConfig = SystemConfig::find($id);
        if (!$systemConfig) {
            return redirect(route('admin.system-configs.index'))
                ->with('failed', 'Có lỗi trong quá trình đổi trạng thái cấu hình hệ thống!');
        }
        if ($systemConfig->group_name == SystemConfig::$EMAIL_GROUP) {
            return redirect(route('admin.system-configs.index'))
                ->with('failed', 'Có lỗi trong quá trình đổi trạng thái cấu hình hệ thống! Không đổi trạng thái các tham số group EMAIL');
        }
        $systemConfig->status = !$systemConfig->status;
        $systemConfig->save();

        return redirect(route('admin.system-configs.index'))
            ->with('success', 'Đổi trạng thái hình hệ thống '. $systemConfig->id .' thành công');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory
     */
    public function create(Request $request)
    {
        $title = 'Tạo mới Cấu hình hệ thống';
        return view('system-config::create', compact('title'));
    }

    /**
     * @param  \Bkv1409\SystemConfig\Models\SystemConfig  $systemConfig
     * @param  \Illuminate\Http\Request  $request
     * @param  boolean  $isFileType
     */
    private function updateSystemConfig(SystemConfig $systemConfig, Request $request, $isFileType)
    {
        if ($isFileType) {
            if ( $request->hasFile('value')) {
                if ($systemConfig->exists === true) { //system-config exist, delete old file
                    Storage::disk('public')->delete($systemConfig->value);
                }
                $path = Storage::disk('public')->putFile('system_configs', $request->file('value'));
                $systemConfig->value = $path;
            }
        } else {
            $systemConfig->value = $request->input('value', '');
        }

        $systemConfig->type = $request->input('type', '');
        $systemConfig->name = Str::upper($request->input('name', ''));
        $systemConfig->display_name = $request->input('display_name', '');

        $systemConfig->group_name = Str::upper($request->input('group_name', ''));
        if ($request->has('status')) {
            $systemConfig->status = $request->input('status') == 1 ? 1 : 0;
        }
        $systemConfig->save();
        // add forget system config when update value
//        SystemConfig::forgetCache($systemConfig->name, $systemConfig->group_name);
        $systemConfig->forgetMe();

    }

    /**
     * @param Request $request
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkValue(Request $request, $id = null)
    {
        $systemConfig = SystemConfig::find($id);
        if (empty($systemConfig)) {
            return response()->json([
                'status' => false,
                'message' => 'System Config does not exist!',
                'value' => 'N/A',
                'name' => 'N/A',
            ]);
        }
        $value = SystemConfig::getValueWithFileConfig($systemConfig->name, null, $systemConfig->group_name);
        if ($value instanceof Carbon) $value = $value->toIso8601String();
        Log::debug('check value '. $value);
        return response()->json([
            'status' => true,
            'message' => 'System Config exist!',
            'value' => $value,
            'name' => SystemConfig::getCombineKey($systemConfig->name, $systemConfig->group_name),
        ]);
    }
}
