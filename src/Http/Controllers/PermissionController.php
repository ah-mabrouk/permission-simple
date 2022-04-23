<?php

namespace Mabrouk\PermissionSimple\Http\Controllers;

use Mabrouk\PermissionSimple\Models\Permission;
use Mabrouk\PermissionSimple\Http\Resources\PermissionResource;
use Mabrouk\PermissionSimple\Http\Requests\PermissionUpdateRequest;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware(\Illuminate\Routing\Middleware\SubstituteBindings::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginationLength = pagination_length('Permission');
        $permissions = Permission::paginate($paginationLength);
        return PermissionResource::collection($permissions);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Mabrouk\PermissionSimple\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        return response([
            'permission' => new PermissionResource($permission),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Mabrouk\PermissionSimple\Http\Requests\PermissionUpdateRequest  $request
     * @param  \Mabrouk\PermissionSimple\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionUpdateRequest $request, Permission $permission)
    {
        $permission = $request->updatePermission();
        return response([
            'message' => __('mabrouk/permission/permissions.update'),
            'permission' => new PermissionResource($permission),
        ]);
    }
}
