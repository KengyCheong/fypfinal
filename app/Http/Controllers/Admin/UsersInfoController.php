<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class UsersInfoController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('users_info_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = UsersInfo::with(['illness_history', 'vaccine_status', 'created_by'])->select(sprintf('%s.*', (new UsersInfo())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'users_info_show';
                $editGate = 'users_info_edit';
                $deleteGate = 'users_info_delete';
                $crudRoutePart = 'users-infos';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('nric_no', function ($row) {
                return $row->nric_no ? $row->nric_no : '';
            });

            $table->editColumn('phone_no', function ($row) {
                return $row->phone_no ? $row->phone_no : '';
            });
            $table->addColumn('illness_history_name', function ($row) {
                return $row->illness_history ? $row->illness_history->name : '';
            });

            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
            });
            $table->editColumn('nationality', function ($row) {
                return $row->nationality ? UsersInfo::NATIONALITY_SELECT[$row->nationality] : '';
            });
            $table->addColumn('vaccine_status_vaccine_status', function ($row) {
                return $row->vaccine_status ? $row->vaccine_status->vaccine_status : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'illness_history', 'vaccine_status']);

            return $table->make(true);
        }

        return view('admin.usersInfos.index');
    }

    public function create()
    {
        abort_if(Gate::denies('users_info_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $illness_histories = IllnessTag::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vaccine_statuses = VaccineTag::pluck('vaccine_status', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.usersInfos.create', compact('illness_histories', 'vaccine_statuses'));
    }

    public function store(StoreUsersInfoRequest $request)
    {
        $usersInfo = UsersInfo::create($request->all());

        return redirect()->route('admin.users-infos.index');
    }

    public function edit(UsersInfo $usersInfo)
    {
        abort_if(Gate::denies('users_info_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $illness_histories = IllnessTag::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vaccine_statuses = VaccineTag::pluck('vaccine_status', 'id')->prepend(trans('global.pleaseSelect'), '');

        $usersInfo->load('illness_history', 'vaccine_status', 'created_by');

        return view('admin.usersInfos.edit', compact('illness_histories', 'vaccine_statuses', 'usersInfo'));
    }

    public function update(UpdateUsersInfoRequest $request, UsersInfo $usersInfo)
    {
        $usersInfo->update($request->all());

        return redirect()->route('admin.users-infos.index');
    }

    public function show(UsersInfo $usersInfo)
    {
        abort_if(Gate::denies('users_info_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usersInfo->load('illness_history', 'vaccine_status', 'created_by');

        return view('admin.usersInfos.show', compact('usersInfo'));
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
