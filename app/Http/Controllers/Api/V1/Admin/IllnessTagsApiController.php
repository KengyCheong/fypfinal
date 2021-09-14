<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIllnessTagRequest;
use App\Http\Requests\UpdateIllnessTagRequest;
use App\Http\Resources\Admin\IllnessTagResource;
use App\Models\IllnessTag;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IllnessTagsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('illness_tag_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IllnessTagResource(IllnessTag::all());
    }

    public function store(StoreIllnessTagRequest $request)
    {
        $illnessTag = IllnessTag::create($request->all());

        return (new IllnessTagResource($illnessTag))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(IllnessTag $illnessTag)
    {
        abort_if(Gate::denies('illness_tag_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IllnessTagResource($illnessTag);
    }

    public function update(UpdateIllnessTagRequest $request, IllnessTag $illnessTag)
    {
        $illnessTag->update($request->all());

        return (new IllnessTagResource($illnessTag))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(IllnessTag $illnessTag)
    {
        abort_if(Gate::denies('illness_tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $illnessTag->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
