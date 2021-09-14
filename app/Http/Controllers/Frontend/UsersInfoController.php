<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUsersInfoRequest;
use App\Http\Requests\StoreUsersInfoRequest;
use App\Http\Requests\UpdateUsersInfoRequest;
use App\Models\IllnessTag;
use App\Models\UsersInfo;
use App\Models\VaccineTag;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersInfoController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('users_info_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usersInfos = UsersInfo::with(['illness_history', 'vaccine_status', 'created_by'])->get();

        return view('frontend.usersInfos.index', compact('usersInfos'));
    }

    public function create()
    {
        abort_if(Gate::denies('users_info_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $illness_histories = IllnessTag::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vaccine_statuses = VaccineTag::pluck('vaccine_status', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.usersInfos.create', compact('illness_histories', 'vaccine_statuses'));
    }

    public function store(StoreUsersInfoRequest $request)
    {
        $usersInfo = UsersInfo::create($request->all());

        return redirect()->route('frontend.users-infos.index');
    }

    public function edit(UsersInfo $usersInfo)
    {
        abort_if(Gate::denies('users_info_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $illness_histories = IllnessTag::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vaccine_statuses = VaccineTag::pluck('vaccine_status', 'id')->prepend(trans('global.pleaseSelect'), '');

        $usersInfo->load('illness_history', 'vaccine_status', 'created_by');

        return view('frontend.usersInfos.edit', compact('illness_histories', 'vaccine_statuses', 'usersInfo'));
    }

    public function update(UpdateUsersInfoRequest $request, UsersInfo $usersInfo)
    {
        $usersInfo->update($request->all());

        return redirect()->route('frontend.users-infos.index');
    }

    public function show(UsersInfo $usersInfo)
    {
        abort_if(Gate::denies('users_info_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usersInfo->load('illness_history', 'vaccine_status', 'created_by');

        return view('frontend.usersInfos.show', compact('usersInfo'));
    }

    public function destroy(UsersInfo $usersInfo)
    {
        abort_if(Gate::denies('users_info_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usersInfo->delete();

        return back();
    }

    public function massDestroy(MassDestroyUsersInfoRequest $request)
    {
        UsersInfo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
