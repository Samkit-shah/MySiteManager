
@extends('layouts.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card  w-275">
                <div class="card-header">{{ __('YOUR LINKS') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                  


                   <div class="card-body">
                    
                   <h3 class="mb-5 mt-4">Welcome {{$user->name}},<br>You have saved {{$posts->count()}} Links</h3>
                     <form action="/home" method="get">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add New links') }}
                                </button>
                    </form>
                </div>

 <div class="col-md-14">
   <form action="/showposts" method="GET">
 <div class="input-group">
    <input type="search" name="search"class="form-control"  placeholder="ENTER THE TITLE HERE TO SEARCH">
    <span class="input-group-prepend">
      <button type="submit" class="btn btn-primary ">Search/Refresh </button>
    </span>
  </div>
  </form>
 </div>

<br>
@if (\Session::has('success'))
    <div class="alert alert-success fade-message">
      
           {!! \Session::get('success') !!}
      
    </div>
     <script>
    $(function(){
        setTimeout(function() {
            $('.fade-message').fadeOut();
        }, 1500);
    });
    </script>
@endif



@if ($posts->count()>0)
@foreach ($posts as $post)
<div class="card">
    <div class="card-body">
        <div class="card-header">
            <h2>{{$post->title}}</h2>
        </div>
       <a style="font-size: 20px">Description </a>{{$post->description }}
        <br />
        <a style="font-size: 20px">Site Link </a>
        <a href="{{$post->sitelink}}">{{$post->sitelink}}</a>
        <br/>
         <a style="font-size: 20px">Posted On </a>{{$post->created_at}}
        <br />
            <form action="{{ route('deletelink', [$post->id]) }}" method="get">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Delete this Link') }}
                                </button>
                    </form>
    </div>
</div>
<br>
@endforeach 
@else
 <div class="alert alert-success" role="alert">
                       No Results
                        </div>
@endif 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
