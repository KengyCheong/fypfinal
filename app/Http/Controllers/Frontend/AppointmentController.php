<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAppointmentRequest;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Models\AppointmentTime;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Brian2694\Toastr\Facades\Toastr;

class AppointmentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('appointment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointments = Appointment::with(['time', 'created_by'])->where('created_by_id', Auth::id())->get();

        return view('frontend.appointments.index', compact('appointments'));
    }

    public function create()
    {
        abort_if(Gate::denies('appointment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $times = AppointmentTime::pluck('time', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.appointments.create', compact('times'));
    }

    public function store(StoreAppointmentRequest $request)
    {
        // check numbers of count
        
        $count = Appointment::whereDate('created_at',Carbon::now())->where('time_id',$request->input('time_id'))->count();
        if($count >= 5){
            Toastr::error('No more slot for this time duration','Appointment Failed');
            return  redirect()->route('frontend.appointments.create');
        }else {
            $appointment = Appointment::create($request->all());
            Toastr::success('No more slot for this time duration','Appointment Success');
            return redirect()->route('frontend.appointments.index');
        }
    }

    public function edit(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $times = AppointmentTime::pluck('time', 'id')->prepend(trans('global.pleaseSelect'), '');

        $appointment->load('time', 'created_by');

        return view('frontend.appointments.edit', compact('times', 'appointment'));
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $appointment->update($request->all());

        return redirect()->route('frontend.appointments.index');
    }

    public function show(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment->load('time', 'created_by');

        return view('frontend.appointments.show', compact('appointment'));
    }

    public function destroy(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment->delete();

        return back();
    }

    public function massDestroy(MassDestroyAppointmentRequest $request)
    {
        Appointment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
