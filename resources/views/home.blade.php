@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card  ">
                <div class="card-header">{{ __('ADD SITE') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   @component('post.newpost')
                       
                   @endcomponent
              


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
