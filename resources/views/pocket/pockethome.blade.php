@extends('layouts.app')

@section('content')

<div class="container">
@if(session('success'))
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('success') }}
    </div>
@endif
    <h1 class="text-center"> Pocket Manager <button class="badge badge-secondary" data-toggle="modal"
            data-target="#exampleModal">Add Event</button></h1>
@if($events->count()>0)
@foreach($events as $events)
      <div class="card" style="width: auto;margin:15px">
          <div class="card-body text-center">
              <h5 class="card-title">{{ $events->event_name }}</h5>
              <h6 class="card-subtitle mb-2 text-muted">
                  Event created on : {{ $events->created_at->format('d/m/Y') }} </h6>
               <a type="submit" class="btn btn-primary text-white"
                   href="{{ route('eventdetails',['eventid'=>$events->id]) }}">View
                   Details</a>
     <a type="submit" class="btn btn-danger text-white"
         href="{{ route('deleteevent',['eventid'=>$events->id]) }}">Delete
         Event</a>

          </div>


    </div>
@endforeach
@else
<div class="alert alert-success" role="alert" style="color:black">
    No Events Found,<br>

    <a style="color: rgb(1, 51, 90);text-decoration:underline;cursor: pointer;"
        data-toggle="modal"
        data-target="#exampleModal">{{ __('Add Important Events here!') }}
    </a>
    <br>
    <a style="color: rgb(1, 51, 90);text-decoration:underline"
        href="{{ route('showpocket') }}">{{ __('Please Refresh Here!') }}
    </a>
</div>
@endif
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('add.event') }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Event</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf

                        <div class="form-group row">
                            <label for="event_name"
                                class="col-md-4 col-form-label text-md-right">{{ __('Event Name') }}</label>
                            <div class="col-md-6">
                                <input id="event_name" type="event_name"
                                    class="form-control @error('event_name') is-invalid @enderror" name="event_name"
                                    value="{{ old('event_name') }}" required autocomplete="event_name" autofocus>

                                @error('event_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <script type="text/javascript">
@if (count($errors) > 0)
    $('#exampleModal').modal('show');
@endif

</script>

@endsection
