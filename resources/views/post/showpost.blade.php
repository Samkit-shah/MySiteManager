@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('css/showpost.css') }}">
<script src="{{ asset('js/showpost.js') }}" type="application/javascript"> </script>

<div class="container">
    <div id="loader">

        <div class="spinner-border centerloading" role="status">

        </div>



    </div>
    <!-- Back to top button -->
    <a id="back2Top" title="Back to top" href="#">&#10148;</a>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">{{ __('YOUR LINKS') }}</div>

                <div class="card-body">
                    @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('status') }}
                    </div>
                    @endif




                    <h3 class="mb-5 mt-4">Welcome {{ $user->name }},<br> You have saved {{ $posts->count() }}
                        Links
                    </h3>
                    <div class="row" style="padding: 5px">
                        <div class="col-md-2" style="padding: 5px">
                            <form action="/home" method="get">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Add New links') }}
                                </button>
                            </form>
                        </div>
                        <div class="col-md-4" style="padding: 5px">
                            <form action="{{ route('sharepost', [$user]) }}" method="get">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Send All The Links Saved to My Mail') }}
                                </button>
                            </form>
                        </div>
                        <div class="col-md-2" style="padding: 5px">
                            <form action="{{ route('downloadpdf', [$user->id]) }}" method="get">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Download As Pdf') }}
                                </button>
                            </form>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md" style="padding:10px ">
                            <form action="/showposts" method="GET">
                                <div class="input-group">
                                    <input type="search" name="searchbytitle" class="form-control" placeholder="Enter The title to search">
                                    <span class="input-group-prepend">
                                        <button type="submit" class="btn btn-primary ">{{ __('Search By Title') }}
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-2 d-flex justify-content-center" style="padding:10px ">
                            <form action="/showposts" method="GET"><button class="btn btn-outline-dark"> Show All</button>
                            </form>
                        </div>
                        <div class="col-md" style="padding:10px;">
                            <form action="/showposts" method="GET">
                                <div class="input-group">
                                    <input type="search" name="searchbydescription" class="form-control"
                                        placeholder="Enter the description word to find ">
                                    <span class="input-group-prepend">
                                        <button type="submit"
                                            class="btn btn-primary ">{{ __('Search by Description') }}
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>



                    <br>




                    @if(Session::has('success'))
                    <div class="alert alert-success fade-message" style="background-color: rgb(133, 146, 146);color:black">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                        {!! Session::get('success') !!}

                    </div>

                    @endif
                    @if(Session::has('mailsent'))
                    <div class="alert alert-success fade-mail-message" style="background-color: rgb(133, 146, 146);color:black">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {!! Session::get('mailsent') !!}

                    </div>


                    @endif


                    @if($posts->count()>0)
@if($searchresults)
    <div class="alert alert-success fade-message" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ $searchresults }}
    </div>
@endif
                    <div class="row">
                        @foreach($posts as $post)
                        <div class="col-sm-4" style="padding: 5px">

                            <div class="card" id="linkdetails" style="min-height:100%" >
                                <div class="card-body" style="padding: 8px">
                                    <div class="card-header">
                                        <h2>{{ $post->title }}</h2>
                                    </div>
                                    <a style="font-size: 20px">Description
                                    </a>{{ $post->description }}
                                    <br />
                                    <a style="font-size: 20px">Site Link </a>
                                    <a href="{{ $post->sitelink }}" target="_blank">{{ $post->sitelink }}</a>
                                    <br />
                                    <a style="font-size: 20px">Posted
                                        On
                                    </a>{{ $post->created_at->format('d/m/Y') }}
                                    <br />
                                    <div class="card-footer" style="background-color: inherit;padding:5px">

                                        <form action="{{ route('deletelink', [$post->id]) }}" method="get">
                                            <button type="submit" class="btn btn-outline-danger">
                                                {{ __('Delete this Link') }}
                                            </button>
                                        </form>

                                    </div>


                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="alert alert-success" role="alert" style="color:black">
                        No Links Found,<br>

                        <a style="color: rgb(1, 51, 90);text-decoration:underline" href="/home">{{ __('Add Important links here!') }}
                        </a>
                        <br>
                        <a style="color: rgb(1, 51, 90);text-decoration:underline" href="/showposts">{{ __('Please Refresh Here!') }}
                        </a>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>


</div>
{{-- <div class="fixed-bottom">

    <div class="alert alert-success" style="margin-bottom: 0">
        <form action="/submitfeedback" method="GET">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>


            <div class="input-group">
                <label for="sitelink"
                    class="col-md-2 col-form-label text-md-right">{{ __('Feedback/Comments') }}</label>
<input type="text" name="feedback" class="form-control " placeholder="Please Share Your Valuable Feedback">
<span class="input-group-prepend">
    <button type="submit" class="btn btn-primary ">{{ __('Submit') }}
    </button>
</span>

</div>
</form>
</div>

</div> --}}
@endsection
