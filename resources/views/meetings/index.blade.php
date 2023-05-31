@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-9">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Subject</th>
                <th>Date/Time</th>
                <th>Creator</th>
                <th>Attendees</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($meetings as $meeting)
                <tr>
                    <td>{{ $meeting->subject }}</td>
                    <td>{{ $meeting->datetime }}</td>
                    <td>{{ $meeting->creator_email }}</td>
                    <td>{{ $meeting->attendee1_email }}, {{ $meeting->attendee2_email }}</td>
                    <td>
                        <a href="{{ route('meetings.edit', $meeting->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('meetings.destroy', $meeting->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
   </div>
</div>
@endSection