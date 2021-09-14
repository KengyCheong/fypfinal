<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyApprovalStatusRequest;
use App\Http\Requests\StoreApprovalStatusRequest;
use App\Http\Requests\UpdateApprovalStatusRequest;
use App\Models\ApprovalStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApprovalStatusController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('approval_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $approvalStatuses = ApprovalStatus::all();

        return view('frontend.approvalStatuses.index', compact('approvalStatuses'));
    }

    public function create()
    {
        abort_if(Gate::denies('approval_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.approvalStatuses.create');
    }

    public function store(StoreApprovalStatusRequest $request)
    {
        $approvalStatus = ApprovalStatus::create($request->all());

        return redirect()->route('frontend.approval-statuses.index');
    }

    public function edit(ApprovalStatus $approvalStatus)
    {
        abort_if(Gate::denies('approval_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.approvalStatuses.edit', compact('approvalStatus'));
    }

    public function update(UpdateApprovalStatusRequest $request, ApprovalStatus $approvalStatus)
    {
        $approvalStatus->update($request->all());

        return redirect()->route('frontend.approval-statuses.index');
    }

    public function show(ApprovalStatus $approvalStatus)
    {
        abort_if(Gate::denies('approval_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.approvalStatuses.show', compact('approvalStatus'));
    }

    public function destroy(ApprovalStatus $approvalStatus)
    {
        abort_if(Gate::denies('approval_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $approvalStatus->delete();

        return back();
    }

    public function massDestroy(MassDestroyApprovalStatusRequest $request)
    {
        ApprovalStatus::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
