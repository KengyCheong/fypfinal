<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TasksCalendarController extends Controller
{
    public function index()
    {
        $events = Task::whereNotNull('due_date')->where('created_by_id', Auth::id())->get();

        return view('frontend.taskCalendar.index', compact('events'));
    }
}
