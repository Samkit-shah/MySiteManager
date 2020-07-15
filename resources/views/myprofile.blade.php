@extends('layouts.app')
@section('myprofile')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card  ">
                <div class="card-header">{{ __('My Profile') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card-body">
                   <ul class="list-group">
  <li class="list-group-item">NAME :{{$user->name}}</li>
  <li class="list-group-item">Email id :{{$user->email}}</li>
  <li class="list-group-item">Contact Number :{{$user->contactno}}</li>
  
<li class="list-group-item">Last Login On:  {{$user->last_sign_in_at->format('d/m/Y')}}   i.e {{$user->last_sign_in_at->DiffForHumans()}}</li>   
 <li class="list-group-item">To Reset Your Password :  @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}" style="padding: 0px">
                                        {{ __('Click here') }}
                                    </a>
                                @endif</li>  
                       
  


</ul>
                    </div>

                        
                    <form method="get" action="{{ route('home') }}">
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add a new link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <form action="/showposts" method="get">
                    <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Show My Links') }}
                                </button>
                            </div>
                            
                        </div>
                        </form>
                         
                </div>
              


                </div>
            </div>
        </div>
    </div>
</div>
@endsection