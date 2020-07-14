 

    
@extends('home')
 @section('search') 

    
 <div class="col-md-4">
   <form action="/search" method="GET">
 <div class="input-group">
    <input type="search" name="search" >
    <span class="input-group-prepend">
      <button type="submit" class="btn btn-primary ">SEARCH</button>
    </span>
  </div>
  </form>
 </div>
 
@if ($searchresult->count()>0)
@foreach ($searchresult as $post)
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
    </div>
</div>
@endforeach 
@endif 

@endsection