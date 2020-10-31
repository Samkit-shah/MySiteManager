@extends('layouts.app')
@section('myprofile')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card  ">
                <div class="card-header">{{ __('My Profile') }}</div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(Session::has('success'))
                        <div class="alert alert-success fade-mail-message">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {!! Session::get('success') !!}

                        </div>

                    @endif
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">Name :{{ $user->name }}</li>
                            <li class="list-group-item">Email id :{{ $user->email }}</li>
                            {{-- <li class="list-group-item">Contact Number :{{ $user->contactno }}
                            </li> --}}

                            <li class="list-group-item">Last Login On:
                                {{ $user->last_sign_in_at->format('d/m/Y') }}
                                i.e {{ $user->last_sign_in_at->DiffForHumans() }}</li>
                            <li class="list-group-item ">To Reset Your Password
                                : @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}"
                                    style="padding: 0px">
                                    {{ __('Click here') }}
                                </a>
                                @endif</li>


                        </ul>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <form method="get" action="{{ route('showpocket') }}">
                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Show My Pocket') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-3">
                            <form method="get" action="{{ route('showposts') }}">
                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Show My Links') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-3">
                            <form method="get" action="{{ route('shownotes') }}">
                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Show My Notes') }}
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>




                </div>

                <div class="alert alert-success" style="margin-bottom: 0">

                    <form action="/submitfeedback" method="GET">



                        <div class="input-group">
                            <label for="sitelink"
                                class="col-md-2 col-form-label text-md-right">{{ __('Feedback/Comments') }}</label>
                            <input type="text" name="feedback" class="form-control "
                                placeholder="Please Share Your Valuable Feedback">
                            <span class="input-group-prepend">
                                <button type="submit" class="btn btn-primary ">{{ __('Submit') }}
                                </button>
                            </span>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
@endsection
