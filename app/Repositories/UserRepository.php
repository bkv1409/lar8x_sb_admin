<?php


namespace App\Repositories;


use App\Models\User;
use App\Models\UserProfile;
use Arr;
use Hash;
use Illuminate\Http\Request;
use Log;
use Storage;

class UserRepository
{
    /**
     * @param  \App\Models\User  $user
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $shouldUpdateRole
     * @return bool
     */
    public function update(User $user, Request $request, $shouldUpdateRole = true)
    {
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user->update($input);

//        DB::table('model_has_roles')->where('model_id', $user->id)->delete();
//        $user->assignRole($request->input('roles'));
        // Update Role
        if ($shouldUpdateRole) $user->syncRoles($request->input('roles'));
        $userProfile = $user->userProfile;
        $userInfo = $request->only('img_link', 'job', 'bio', 'skills', 'experience');
        if (!empty($userProfile)) {
            // delete current file
            if ($request->hasFile('img_link')) {
                try {
                    Storage::disk('public')->delete($userProfile->img_link);
                } catch (\Throwable $exception) {
                    Log::warning('Delete old file failed');
                    Log::warning($exception->getMessage());
                }
            }
        } else {
            $userProfile = new UserProfile();
        }
        // upload file
        $userImageLink = $this->uploadFile($request);
        if (!empty($userImageLink)) $userInfo['img_link'] = $userImageLink;
        // Lưu thông tin vào profile
        $userProfile->fill($userInfo);
        $userProfile->save();
        $user->userProfile()->associate($userProfile);
        $user->save();
        return true;
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        $userInfo = $request->only('img_link', 'job', 'bio', 'skills', 'experience');
        // upload file
        $userImageLink = $this->uploadFile($request);
        if (!empty($userImageLink)) $userInfo['img_link'] = $userImageLink;
        // Lưu thông tin vào profile
        $userProfile = UserProfile::create($userInfo);
        $user->userProfile()->associate($userProfile);
        $user->save();
        return true;
    }

    /**
     * @param $request
     * @return string
     */
    private function uploadFile($request)
    {
        // xử lý upload ảnh avatar
        if ($request->hasFile('img_link')) {
            return Storage::disk('public')->putFile('users', $request->file('img_link'));
        }
        return '';
    }
}
