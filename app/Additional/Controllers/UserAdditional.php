<?php

namespace App\Additional\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\Setting;
use App\Services\RoleService;
use App\Services\UserService;
use App\Services\SettingService;

/**
 * Trait UserAdditional
 * @package App\Additional\Controllers
 */
trait UserAdditional
{
    /**
     * @var array $_allowedItems
     */
    protected $_allowedItems = [
        'settings' => null,
        'modules' => 'union',
        'dashboards' => 'union',
        'roles' => null
    ];

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function toggleRole($id)
    {
        RoleService::checkPermissions('edit-user');
        $this->_validate();

        $user = User::find($id);

        if (!$user) {
            throw new \Exception(trans('exception.recordNotFound', ['item' => 'User', 'id' => $id]));
        }

        $role = $this->_getRole();

        if ($user->hasRole($role->name)) {
            if (count($user->roles) > 1) {
                $user->detachRole($role);
            } else {
                $user->detachRole($role);
                $user->attachRole(Role::where('name', '=', 'regular-user')->first());
            }
        } else {
            $user->attachRole($role);
        }

        \Cache::flush();

        return $this->_responseService->single(
            User::with('roles')->find($id),
            $this->_getSingleItemKey(),
            $user->hasRole($role->name) ? "Role $role->name added to user" : "Role $role->name removed from user"
        );
    }

    /**
     * @param int $id
     * @throws \Exception
     */
    public function togglePermission($id)
    {
        RoleService::checkRoles('admin');
        $this->_validate(false);

        $role = $this->_getRole($id);

        $permissionId = request('permission_id');
        $permission = Permission::find($permissionId);

        if (!$permission) {
            throw new \Exception(trans('exception.recordNotFound', ['item' => 'Permission', 'id' => $permissionId]));
        }

        if($role->name === 'admin'){
            throw new \Exception(trans('exception.access.permission'));
        }

        if($role->hasPermission($permission->name)){
            $role->detachPermission($permission);
        }else{
            $role->attachPermission($permission);
        }

        \Cache::forget('user_permissions_' . \Auth::id());

        return $this->_responseService->single(
            User::with('roles')->find($id),
            $this->_getSingleItemKey(),
            $role->hasPermission($permission->name) ? "Permission $permission->name added to role $role->name" : "Permission $permission->name removed from role $role->name"
        );
    }

    /**
     * @param string $item
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function item($item)
    {
        if (!method_exists($this->_modelClass, $item) || !array_key_exists($item, $this->_allowedItems)) {
            throw new \Exception(trans('exception.itemNotFound', ['item' => $item]));
        }

        $result = UserService::getUserItem($item,
            isset($this->_allowedItems[$item]) && $this->_allowedItems === 'union');

        return $this->_responseService->single(
            $result,
            $item);
    }

    /**
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function updateSubscription($id) {
        RoleService::checkPermissions('edit-user');

        if (!request()->filled('abbreviation')) {
            throw new \InvalidArgumentException('You must include abbreviation field in the payload request.');
        }
        if (!request()->get('abbreviation')) {
            throw new \InvalidArgumentException('Abbreviation field should contain a valid subscription identifier.');
        }

        $payload = ['abbreviations' => [request()->get('abbreviation')]];
        // Check if provided subscription has valid data 
        SettingService::validateSettingAssignment('subscriptions', json_encode($payload));

        $subscriptions = Setting::where(['user_id' => $id, 'key' => 'subscriptions'])->first();
        if (!$subscriptions) {
            throw new \Exception(trans('exception.recordNotFound', ['item' => 'Subscriptions', 'id' => $id]));
        }
        
        $updated = $subscriptions->update(['value' => json_encode($payload)]);
        if (!$updated) {
            throw new \Exception(trans('exception.canNotUpdate', ['item' => 'Subscriptions', 'id' => $id]));
        }

        return $this->_responseService->single($subscriptions, null, 'Subscriptions updated successfully.');
    }

    /**
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function updateSetting($id) {
        RoleService::checkPermissions('edit-user');

        $key = request('key');
        $value = request('value');

        if (!request()->filled('key')) {
            throw new \InvalidArgumentException('Field key is required to properly define the setting to update.');
        }
        if (!request()->filled('value')) {
            throw new \InvalidArgumentException('Field value is required to properly update setting record.');
        }

        // Check if provided values with related setting key exists and are valid
        SettingService::validateSettingAssignment($key, $value);

        $setting = Setting::where(['user_id' => $id, 'key' => $key])->first(); 
        if (!$setting) {
            throw new \Exception(trans('exception.recordNotFound', ['item' => 'Setting', 'id' => $id, 'key' => $key]));
        }

        $updated = $setting->update(['value' => $value]);
        if (!$updated) {
            throw new \Exception(trans('exception.canNotUpdate', ['item' => 'Setting', 'id' => $id, 'key' => $key]));
        }

        return $this->_responseService->single($setting, null, 'Setting updated successfully.');
    }

    /**
     * @param bool $role
     * @return void
     */
    protected function _validate($role = true)
    {
        $rules = $role ? [
            'role_id' => 'required'
        ] : [
            'permission_id' => 'required'
        ];

        $this->validate(request(), $rules);
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     * @throws \Exception
     */
    protected function _getRole($id = null){
        $roleId = null === $id ? request('role_id') : $id;
        $role = Role::find($roleId);

        if (!$role) {
            throw new \Exception(trans('exception.recordNotFound', ['item' => 'Role', 'id' => $roleId]));
        }

        return $role;
    }
}