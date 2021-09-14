<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVaccineTagRequest;
use App\Http\Requests\StoreVaccineTagRequest;
use App\Http\Requests\UpdateVaccineTagRequest;
use App\Models\VaccineTag;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VaccineTagsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('vaccine_tag_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vaccineTags = VaccineTag::all();

        return view('frontend.vaccineTags.index', compact('vaccineTags'));
    }

    public function create()
    {
        abort_if(Gate::denies('vaccine_tag_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.vaccineTags.create');
    }

    public function store(StoreVaccineTagRequest $request)
    {
        $vaccineTag = VaccineTag::create($request->all());

        return redirect()->route('frontend.vaccine-tags.index');
    }

    public function edit(VaccineTag $vaccineTag)
    {
        abort_if(Gate::denies('vaccine_tag_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.vaccineTags.edit', compact('vaccineTag'));
    }

    public function update(UpdateVaccineTagRequest $request, VaccineTag $vaccineTag)
    {
        $vaccineTag->update($request->all());

        return redirect()->route('frontend.vaccine-tags.index');
    }

    public function show(VaccineTag $vaccineTag)
    {
        abort_if(Gate::denies('vaccine_tag_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vaccineTag->load('vaccineStatusUsersInfos');

        return view('frontend.vaccineTags.show', compact('vaccineTag'));
    }

    public function destroy(VaccineTag $vaccineTag)
    {
        abort_if(Gate::denies('vaccine_tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vaccineTag->delete();

        return back();
    }

    public function massDestroy(MassDestroyVaccineTagRequest $request)
    {
        VaccineTag::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
