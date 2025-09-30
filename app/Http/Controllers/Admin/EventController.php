<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    // Show participants for a given event (admin view)
    public function participants($eventId)
    {
        $event = Event::with('users')->findOrFail($eventId);
        $participants = $event->users;
        return view('admin.events.participants', compact('event', 'participants'));
    }
    // Display a listing of events
    public function index()
    {
        $events = Event::orderBy('date', 'desc')->paginate(20);
        return view('admin.events.index', compact('events'));
    }

    // Show the form for creating a new event
    public function create()
    {
        $categories = \App\Models\Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.events.create', compact('categories'));
    }

    // Store a newly created event
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date|after_or_equal:today',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'max_participants' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
        ]);
        $validated['current_participants'] = 0;
        $validated['is_active'] = true;
        Event::create($validated);
        return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
    }

    // Show the form for editing an event
    public function edit(Event $event)
    {
        $categories = \App\Models\Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.events.edit', compact('event', 'categories'));
    }

    // Update the specified event
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date|after_or_equal:today',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'max_participants' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
        ]);
        $event->update($validated);
        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
    }

    // Remove the specified event
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
    }
}
