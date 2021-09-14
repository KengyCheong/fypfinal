<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAppointmentTimeRequest;
use App\Http\Requests\StoreAppointmentTimeRequest;
use App\Http\Requests\UpdateAppointmentTimeRequest;
use App\Models\AppointmentTime;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppointmentTimeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('appointment_time_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointmentTimes = AppointmentTime::all();

        return view('frontend.appointmentTimes.index', compact('appointmentTimes'));
    }

    public function create()
    {
        abort_if(Gate::denies('appointment_time_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.appointmentTimes.create');
    }

    public function store(StoreAppointmentTimeRequest $request)
    {
        $appointmentTime = AppointmentTime::create($request->all());

        return redirect()->route('frontend.appointment-times.index');
    }

    public function edit(AppointmentTime $appointmentTime)
    {
        abort_if(Gate::denies('appointment_time_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.appointmentTimes.edit', compact('appointmentTime'));
    }

    public function update(UpdateAppointmentTimeRequest $request, AppointmentTime $appointmentTime)
    {
        $appointmentTime->update($request->all());

        return redirect()->route('frontend.appointment-times.index');
    }

    public function show(AppointmentTime $appointmentTime)
    {
        abort_if(Gate::denies('appointment_time_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.appointmentTimes.show', compact('appointmentTime'));
    }

    public function destroy(AppointmentTime $appointmentTime)
    {
        abort_if(Gate::denies('appointment_time_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointmentTime->delete();

        return back();
    }

    public function massDestroy(MassDestroyAppointmentTimeRequest $request)
    {
        AppointmentTime::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
