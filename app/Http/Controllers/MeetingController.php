<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Meetings;
use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;

class MeetingController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'subject' => 'required',
            'datetime' => 'required|date',
            'creator_email' => 'required|email',
            'attendee1_email' => 'required|email',
            'attendee2_email' => 'required|email',
        ]);
    
        // Create a new meeting
        $meeting = new Meetings();
        $meeting->subject = $request->subject;
        $meeting->datetime = $request->datetime;
        $meeting->creator_email = $request->creator_email;
        $meeting->attendee1_email = $request->attendee1_email;
        $meeting->attendee2_email = $request->attendee2_email;
        $meeting->save();
    
        // Create the event in Google Calendar
        $event = new Event;
        $event->name = $request->subject;
        $event->startDateTime = Carbon::now();
        $event->endDateTime = Carbon::parse($request->datetime);
        $event->addAttendee([
            'email' => $request->creator_email,
            'comment' => $request->subject,
        ]);
        $event->addAttendee(['email' => 'anotherEmail@gmail.com']);
        $event->save();
    
        return redirect()->back()->with('success', 'Meeting created successfully.');
    }

    public function index()
    {   
        $events = Event::get(); // here is the confision which meatings will be shown either of google calender or from database i show from database 
        $meetings = Meetings::all();
        return view('meetings.index', compact('meetings'));
    }

    public function edit(Meetings $meeting)
    {
        return view('meetings.edit', compact('meeting'));
    }

    public function update(Request $request, Meetings $meeting,)
    {
        // Validate the request data
        $request->validate([
            'subject' => 'required',
            'datetime' => 'required|date',
            'creator_email' => 'required|email',
            'attendee1_email' => 'required|email',
            'attendee2_email' => 'required|email',
        ]);

        // // Find the meeting by ID
        // $meeting = Meetings::findOrFail($id);

        // Update the meeting details
        $meeting->subject = $request->subject;
        $meeting->datetime = $request->datetime;
        $meeting->creator_email = $request->creator_email;
        $meeting->attendee1_email = $request->attendee1_email;
        $meeting->attendee2_email = $request->attendee2_email;
        $meeting->save();

        // Update the corresponding event in Google Calendar
        $event = Event::findEventById($meeting->event_id);
        $event->name = $request->subject;
        $event->startDateTime = Carbon::now();
        $event->endDateTime = Carbon::parse($request->datetime);
        $event->updateAttendee([
            'email' => $request->creator_email,
            'comment' => $request->subject,
        ]);
        $event->updateAttendee(['email' => 'anotherEmail@gmail.com']);
        $event->save();

        return redirect()->back()->with('success', 'Meeting updated successfully.');
    }

    

    public function destroy($id)
    {
        // Find the meeting by ID
        $meeting = Meeting::findOrFail($id);
    
        // Delete the corresponding event from Google Calendar
        $event = Event::findEventById($meeting->event_id);
        if ($event) {
            $event->delete();
        }
    
        // Delete the meeting from the database
        $meeting->delete();
    
        return redirect()->back()->with('success', 'Meeting deleted successfully.');
    }
}
