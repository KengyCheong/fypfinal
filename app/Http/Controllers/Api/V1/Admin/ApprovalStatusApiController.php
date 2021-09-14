<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApprovalStatusRequest;
use App\Http\Requests\UpdateApprovalStatusRequest;
use App\Http\Resources\Admin\ApprovalStatusResource;
use App\Models\ApprovalStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApprovalStatusApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('approval_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ApprovalStatusResource(ApprovalStatus::all());
    }

    public function store(StoreApprovalStatusRequest $request)
    {
        $approvalStatus = ApprovalStatus::create($request->all());

        return (new ApprovalStatusResource($approvalStatus))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ApprovalStatus $approvalStatus)
    {
        abort_if(Gate::denies('approval_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ApprovalStatusResource($approvalStatus);
    }

    public function update(UpdateApprovalStatusRequest $request, ApprovalStatus $approvalStatus)
    {
        $approvalStatus->update($request->all());

        return (new ApprovalStatusResource($approvalStatus))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ApprovalStatus $approvalStatus)
    {
        abort_if(Gate::denies('approval_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $approvalStatus->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
