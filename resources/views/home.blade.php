@extends('layouts.app')

@section('content')
<div class="container">
<div class="w3-sidebar w3-light-grey w3-bar-block" style="width:25%">
  <h3 class="w3-bar-item">Menu</h3>
  <a href="{{route('meetings.index')}}" class="w3-bar-item w3-button">Meetings List</a>
</div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('meetings.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="subject">Subject:</label>
                            <input type="text" name="subject" id="subject" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="datetime">Date/Time:</label>
                            <input type="datetime-local" name="datetime" id="datetime" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="creator_email">Creator's Email:</label>
                            <input type="email" name="creator_email" id="creator_email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="attendee1_email">Attendee 1 Email:</label>
                            <input type="email" name="attendee1_email" id="attendee1_email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="attendee2_email">Attendee 2 Email:</label>
                            <input type="email" name="attendee2_email" id="attendee2_email" class="form-control" required>
                        </div>
                         </br>

                        <button type="submit" class="btn btn-primary">Create Meeting</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
