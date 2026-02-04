<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $upcomingEvents = Event::where('start_date', '>=', now())
            ->orderBy('start_date', 'asc')
            ->get();
            
        $pastEvents = Event::where('end_date', '<', now())
            ->orderBy('start_date', 'desc')
            ->limit(6)
            ->get();
        
        return view('events.index', compact('upcomingEvents', 'pastEvents'));
    }
    
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }
}