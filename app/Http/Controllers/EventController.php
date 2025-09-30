<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Show participants for a given event (professor view).
     */
    public function participants($eventId)
    {
        $event = Event::with('users')->findOrFail($eventId);
        $participants = $event->users;
        return view('events.participants', compact('event', 'participants'));
    }
    /**
     * Register the authenticated user for an event.
     */
    public function register($eventId)
    {
        $user = auth()->user();
        $event = Event::findOrFail($eventId);

        // Check if already registered
        if ($event->users()->where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('error', 'You are already registered for this event.');
        }

        // Register user
        $event->users()->attach($user->id, ['registered_at' => now()]);

        // Optionally increment current_participants
        $event->increment('current_participants');

        return redirect()->back()->with('success', 'You have registered for the event!');
    }
    /**
     * Display the front office events list for students and professors.
     */
    public function frontoffice()
    {
        $events = Event::where('is_active', true)
            ->whereDate('date', '>=', now())
            ->orderBy('date', 'asc')
            ->with('category')
            ->get();
        return view('events.frontoffice', compact('events'));
    }
    /**
     * Display a listing of events for users (browse available events).
     */
    public function index()
    {
        $events = Event::where('is_active', true)
            ->whereDate('date', '>=', now())
            ->orderBy('date', 'asc')
            ->with('category')
            ->paginate(10);
        return view('events.index', compact('events'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }
}
