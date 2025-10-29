<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\View\View;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index(): View
    {
        $events = Event::with('createdBy')->paginate(10);
        $events->getCollection()->transform(function ($event) {
            $avatar = $event->createdBy->avatar ? asset('img/profile/' . $event->createdBy->avatar) : asset('img/avatar.jpg');

            $startDate = Carbon::parse($event->start_at)->format('d M Y') ?? '';
            $endDate = Carbon::parse($event->end_at)->format('d M Y') ?? '';
            $totalDuration = Carbon::parse($event->start_at)->diffForHumans($event->end_at, true) ?? '';
            $event->description = substr($event->description, 0, 200). '...' ?? '';
            $event->created_by = $event->createdBy->name ?? 'No Name Specified';
            $event->create_time = $event->created_at->diffForHumans() ?? '';
            $event->time = $startDate . ' To ' . $endDate . ' (' . $totalDuration . ')';
            $event->created_by_avatar = $avatar;
            return $event;
        });

        return view('public.event.index', compact('events'));
    }

    public function show(Event $event) {
        $event->load('createdBy');
        $startDate = Carbon::parse($event->start_at)->format('d M Y') ?? '';
        $endDate = Carbon::parse($event->end_at)->format('d M Y') ?? '';
        $totalDuration = Carbon::parse($event->start_at)->diffForHumans($event->end_at, true) ?? '';
        $event->created_by = $event->createdBy->name ?? 'No Name Specified';
        $event->created_by_avatar = $event->createdBy->avatar ? asset('img/profile/' . $event->createdBy->avatar) : asset('img/avatar.jpg');
        $event->create_time = $event->created_at->diffForHumans() ?? '';
        $event->time = $startDate . ' To ' . $endDate . ' (' . $totalDuration . ')';
        $event->type = Event::EVENT_TYPES[$event->event_type_id] ?? 'No Type Specified';
        return view('public.event.show', compact('event'));
    }
}
