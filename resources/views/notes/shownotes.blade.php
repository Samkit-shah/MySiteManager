@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('css/shownotes.css') }}">

<script src="{{ asset('js/shownotes.js') }}" type="application/javascript"> </script>
<div class="container">
    <div id="loader">
        <div class="spinner-border centerloading" role="status">

        </div>
    </div>
    <!-- Back to top button -->
    <a id="backtoTop" title="Back to top" href="#">&#10148;</a>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">{{ __('YOUR NOTES') }}</div>

                <div class="card-body">
                    @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('status') }}
                    </div>
                    @endif




                    <h3 class="mb-5 mt-4">Welcome {{ $user->name }},<br> You have saved {{ $notes->count() }}
                        Notes
                    </h3>
                    <div class="row" style="padding: 5px">
                        <div class="col-md-2" style="padding: 5px">
                            <form action="{{ route('addnotes') }}" method="get">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Add New Notes') }}
                                </button>
                            </form>
                        </div>
                        <div class="col-md-4" style="padding: 5px">
                            <form action="{{ route('sharenotesmail', [$user]) }}" method="get">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Send All The Notes saved to My Mail') }}
                                </button>
                            </form>
                        </div>
                        <div class="col-md-2" style="padding: 5px">
                            <form action="{{ route('downloadpdfofnotes', [$user->id]) }}" method="get">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Download As Pdf') }}
                                </button>
                            </form>
                        </div>

                    </div>


                    <div class="col-md-14">
                        <form action="{{ route('shownotes') }}" method="GET">
                            <div class="input-group">
                                <input type="search" name="search" class="form-control"
                                    placeholder="ENTER THE TITLE HERE TO SEARCH">
                                <span class="input-group-prepend">
                                    <button type="submit" class="btn btn-primary ">{{ __('Search/Refresh') }}
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>

                    <br>
                    @if(Session::has('success'))
                    <div class="alert alert-success fade-message"
                        style="background-color: rgb(133, 146, 146);color:black">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                        {!! Session::get('success') !!}

                    </div>

                    @endif
                    @if(Session::has('mailsent'))
                    <div class="alert alert-success fade-mail-message"
                        style="background-color: rgb(133, 146, 146);color:black">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {!! Session::get('mailsent') !!}

                    </div>


                    @endif


                    @if($notes->count()>0)
                    <div class="row">
                        @foreach($notes as $note_details)
                        <div class="col-sm-4" style="padding: 5px">

                            <div class="card" id="linkdetails" style="min-height:100%">
                                <div class="card-body" style="padding: 8px">
                                    <div class="card-header">
                                        <h2>{{ $note_details->topic }}</h2>
                                    </div>
                                    @if($note_details->typeofnote == 'list')

                                    @foreach(unserialize($note_details->note_data) as $mynote)
                                    <li>{{ $mynote }}</li>
                                    @endforeach
                                    {{-- <li>{{ unserialize($note_details->note_data) }}</li> --}}
                                    <a style="font-size: 13px">Posted
                                        On
                                    </a>{{ $note_details->created_at->format('d/m/Y') }}

                                    @else

                                    <p style="text-align: justify;padding:5px">{{ $note_details->note_data }}</p>

                                    <a style="font-size: 13px">Posted
                                        On
                                    </a>{{ $note_details->created_at->format('d/m/Y') }}
                                    @endif
                                    <div class="row">
                                        <div class="col">
                                            <form action="{{ route('deletenote', [$note_details->id]) }}" method="get">
                                                <button type="submit" class="btn btn-outline-danger">
                                                    {{ __('Delete this Note') }}
                                                </button>

                                            </form>
                                        </div>
                                        <div class="col">
                                            <form action="{{ route('editnote', [$note_details->id]) }}" method="get">
                                                <button type="submit" class="btn btn-outline-secondary">
                                                    {{ __('Update this Note') }}
                                                </button>

                                            </form>
                                        </div>
                                    </div>

                                </div>


                            </div>
                        </div>
                        @endforeach

                    </div>

                    {{ $notes->links('notes.paginator') }}
                </div>
                @else
                <div class="alert alert-success" role="alert" style="color:black">
                    No Notes Found,<br>

                    <a style="color: rgb(1, 51, 90);text-decoration:underline"
                        href="/home">{{ __('Add Important Notes here!') }}
                    </a>
                    <br>
                    <a style="color: rgb(1, 51, 90);text-decoration:underline"
                        href="/showposts">{{ __('Please Refresh Here!') }}
                    </a>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>


</div>

@endsection
