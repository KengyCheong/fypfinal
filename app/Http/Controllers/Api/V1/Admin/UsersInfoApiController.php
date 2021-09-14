<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUsersInfoRequest;
use App\Http\Requests\UpdateUsersInfoRequest;
use App\Http\Resources\Admin\UsersInfoResource;
use App\Models\UsersInfo;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersInfoApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('users_info_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UsersInfoResource(UsersInfo::with(['illness_history', 'vaccine_status', 'created_by'])->get());
    }

    public function store(StoreUsersInfoRequest $request)
    {
        $usersInfo = UsersInfo::create($request->all());

        return (new UsersInfoResource($usersInfo))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(UsersInfo $usersInfo)
    {
        abort_if(Gate::denies('users_info_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UsersInfoResource($usersInfo->load(['illness_history', 'vaccine_status', 'created_by']));
    }

    public function update(UpdateUsersInfoRequest $request, UsersInfo $usersInfo)
    {
        $usersInfo->update($request->all());

        return (new UsersInfoResource($usersInfo))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(UsersInfo $usersInfo)
    {
        abort_if(Gate::denies('users_info_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usersInfo->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
