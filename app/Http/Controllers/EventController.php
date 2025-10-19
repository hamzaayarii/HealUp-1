<?php
namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Recommend events for the authenticated user using the Python AI module.
     */
    public function recommendEvents()
    {
        $interests = $this->getUserInterestCategories();
        // Prepare the command to call the Python recommender
    $command = "python ../python_ai/event_recommender.py \"{$interests}\"";
        // Run the command and capture output
        $output = [];
        $return_var = 0;
        exec($command, $output, $return_var);
        // Parse recommended events from output (simple parsing for demo)
        $recommended = [];
        foreach ($output as $line) {
            if (preg_match('/^- (.+) \((.+)\): (.+)$/', $line, $matches)) {
                // Try to find the event in the DB by title and date
                $event = \App\Models\Event::where('title', $matches[1])
                    ->where('date', $matches[2])
                    ->first();
                $recommended[] = [
                    'title' => $matches[1],
                    'date' => $matches[2],
                    'description' => $matches[3],
                    'id' => $event ? $event->id : null,
                ];
            }
        }
        return view('events.recommend', compact('recommended'));
    }
    /**
     * Unregister the authenticated user from an event.
     */
    public function unregister($eventId)
    {
        $user = auth()->user();
        $event = Event::findOrFail($eventId);

        // Check if registered
        if (!$event->users()->where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('error', 'You are not registered for this event.');
        }

        // Unregister user
        $event->users()->detach($user->id);

        // Optionally decrement current_participants
        if ($event->current_participants > 0) {
            $event->decrement('current_participants');
        }

        return redirect()->back()->with('success', 'You have unregistered from the event.');
    }
    /**
     * Show events the authenticated student is registered for.
     */
    public function myEvents()
    {
        $user = auth()->user();
        $query = \App\Models\Event::whereHas('users', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })->with('category')->orderBy('date', 'asc');
        $search = request('search');
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        $events = $query->paginate(10)->withQueryString();
        return view('events.my', compact('events', 'search'));
    }
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
        $query = Event::where('is_active', true)
            ->whereDate('date', '>=', now())
            ->orderBy('date', 'asc')
            ->with('category');
        $search = request('search');
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        $events = $query->paginate(10)->withQueryString();
        return view('events.frontoffice', compact('events', 'search'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }
    /**
     * Get participated event categories for the authenticated user as a comma-separated string.
     */
    public function getUserInterestCategories()
    {
        $user = auth()->user();
        $categories = Event::whereHas('users', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })
        ->with('category')
        ->get()
        ->pluck('category.name')
        ->unique()
        ->implode(', ');
        \Log::info('getUserInterestCategories called for user: ' . ($user ? $user->id : 'guest') . ' | interests: ' . $categories);
        return $categories;
    }
}
