<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVaccineTagRequest;
use App\Http\Requests\UpdateVaccineTagRequest;
use App\Http\Resources\Admin\VaccineTagResource;
use App\Models\VaccineTag;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VaccineTagsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('vaccine_tag_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VaccineTagResource(VaccineTag::all());
    }

    public function store(StoreVaccineTagRequest $request)
    {
        $vaccineTag = VaccineTag::create($request->all());

        return (new VaccineTagResource($vaccineTag))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(VaccineTag $vaccineTag)
    {
        abort_if(Gate::denies('vaccine_tag_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VaccineTagResource($vaccineTag);
    }

    public function update(UpdateVaccineTagRequest $request, VaccineTag $vaccineTag)
    {
        $vaccineTag->update($request->all());

        return (new VaccineTagResource($vaccineTag))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(VaccineTag $vaccineTag)
    {
        abort_if(Gate::denies('vaccine_tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vaccineTag->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
