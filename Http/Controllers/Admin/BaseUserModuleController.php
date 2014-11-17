<?php namespace User\Http\Controllers\Admin;

use Core\Http\Controllers\Admin\AdminBaseController;

abstract class BaseUserModuleController extends AdminBaseController
{
    /**
     * @var PermissionManager
     */
    protected $permissions;

    /**
     * @param $request
     * @return array
     */
    protected function mergeRequestWithPermissions($request)
    {
        return array_merge($request->all(), ['permissions' => $this->permissions->clean($request->permissions)]);
    }
}
