<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BackendEventRequest;
use App\Notifications\NewEventNotification;

class EventController extends Controller
{
    /**
     * Display a listing of the event.
     */
    public function index(Request $request)
    {
        $request->validate([
            'search' => 'sometimes|required|string',
        ]);


        $events = Event::query()
            ->search($request->search)
            ->latest()
            ->paginate(15);

        $events->getCollection()->transform(function ($event) {
            $event->type = Event::EVENT_TYPES[$event->event_type_id];
            $event->duration = Carbon::parse($event->start_at)->diffForHumans($event->end_at, true);
            $event->create_date = date('d M Y', strtotime($event->created_at));
            return $event;
        });

        return view('backend.event.index', compact('events'));
    }

    /**
     * Show the form for creating a new event.
     */
    public function create()
    {
        return view('backend.event.create_update', [
            'event' => null,
            'types' => Event::EVENT_TYPES,
        ]);
    }

    /**
     * Store a newly created event in storage.
     */
    public function store(BackendEventRequest $request, Event $event)
    {
        $event->fill($request->validated())->save();

        $users = User::query()
            ->where('role_id', 2)
            ->get();

        $users->each(function ($user) use ($event) {
            $user->notify(new NewEventNotification($event));
        });

        return redirect()
            ->route('events.index')
            ->with('success', 'Event created successfully');
    }

    /**
     * Display the specified event.
     */
    public function show(Event $event)
    {
        return view('backend.event.show', [
            'event' => $event,
            'types' => Event::EVENT_TYPES,
        ]);
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit(Event $event)
    {
        return view('backend.event.create_update', [
            'event' => $event,
            'types' => Event::EVENT_TYPES,
        ]);
    }

    /**
     * Update the specified event in storage.
     */
    public function update(BackendEventRequest $request, Event $event)
    {
        $event->update($request->validated());

        return redirect()
            ->route('events.index')
            ->with('success', 'Event updated successfully');
    }

    /**
     * Remove the specified event from storage.
     */
    public function destroy($id)
    {
        //
    }
}
