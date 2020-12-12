@extends('layouts.app')
<style>
    @media (max-width:450px) {
        .editpurpose {
            font-size: small !important;
            margin-top: 2px;
        }
        a.addbtn {
            font-size: small !important;
            padding: 5px !important;
        }
        .amountdiv{
            font-size: small !important
        }
    }
</style>
@section('content')

<div class="container">
    @if(count($errors) > 0)
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Amount is always integer. Please make sure that you Enter a Number
    </div>
    @endif @foreach($events as $events) @endforeach @if(session('success'))
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> {{ session('success') }}
    </div>
    @endif @if($events->count()>0)
    <div class="card" style="width: 100%;">
        <div class="card-body text-center">
            {{--
            <h5 class="card-title">{{ $events->event_name }}</h5> --}}
            <h2 class="card-title mb-2 " style="text-transform: capitalize">{{ $events->event_name }}</h2>
            <div class="row">
                <div class="col" style="padding-right:0px;border-right:2px solid black">
                    <h1 class="text-center heading bg-info" style="padding: 10px">Earned
                        <a style="padding:5px 7px !important" type="button" class="btn btn-dark text-white addbtn" data-toggle="modal" data-target="#addearned">+ Add</a>
                        <small><a id="addearnednote" class="badge badge-success editpurpose" style="cursor: pointer">Edit-purpose</a></small>
                    </h1>

                    @foreach($earned as $earned)


                    <div class="text-center amountdiv">
                        <h4 style="margin:10px 0 0 0 !important">{{ $earned->earned }}
                        </h4>
                        <h5 class="showearnednote">{{ $earned->earned_note }}</h5>
                        <div class="addearnednoteform" style="display: none">
                            <form method="POST" action="{{ route('add.earnednote',['earnedid'=>$earned->id]) }}">
                                @csrf
                                <div class="form-group ">
                                    {{-- <label for="earned_note" class="col-md-4 col-form-label text-md-right">{{ __('Earned Purpose/Note') }}</label> --}}
                                    <div class="col-md-5 mx-auto">
                                        <input id="earned_note" type="text" class="form-control @error('earned_note') is-invalid @enderror" name="earned_note" value="{{ old('earned_note') }}" required autocomplete="earned_note" autofocus placeholder="{{ $earned->earned_note }}" style="border: 0;
                                        border-bottom: 2px solid black;
                                        font-size: 1.3rem;
                                        padding: 7px 0;
                                        background: transparent;
                                        transition: border-color 0.2s;"> @error('earned_note')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span> @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                        {{-- {{ $earned->id }} --}} Posted at :{{ $earned->created_at->format('d/m/Y g:i a.') }}

                    </div>
                    <hr> @endforeach

                </div>
                <div class="col" style="padding-left:0px">
                    <h1 class="text-center heading bg-warning " style="padding: 10px">Spent
                        <a style="padding:5px 7px !important" type="button" class="btn btn-dark text-white addbtn" data-toggle="modal" data-target="#addspent">+ Add</a>
                        <small><a id="addspentnote" class="badge badge-success editpurpose" style="cursor: pointer">Edit-purpose</a></small>
                    </h1>
                    @foreach($spent as $spent)


                    <div class="text-center amountdiv">
                        <h4> {{ $spent->spent }} </h4>
                        <h5 class="showspentnote">{{ $spent->spent_note }}</h5>
                        <div class="addspentnoteform" style="display: none">
                            <form  method="POST" action="{{ route('add.spentnote',['spentid'=>$spent->id]) }}">
                                @csrf
                                <div class="form-group">
                                    {{-- <label for="spent_note" class="col-md-4 col-form-label text-md-right">{{ __('spent Purpose/Note') }}</label> --}}
                                    <div class="col-md-4 mx-auto">
                                        <input id="spent_note" type="text" class="form-control @error('spent_note') is-invalid @enderror" name="spent_note" value="{{ old('spent_note') }}" required autocomplete="spent_note" autofocus placeholder="{{ $spent->spent_note }}" style="border: 0;
                                        border-bottom: 2px solid black;
                                        outline: 0;
                                        font-size: 1.3rem;
                                        background: transparent;
                                        transition: border-color 0.2s;"> @error('earned_note')
                                        <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                         </span> @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                        Posted at :{{ $spent->created_at->format('d/m/Y g:i a.') }}
                    </div>
                    <hr>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col" style="padding-right:0px">
                    <div class="totalearned badge badge-success" style="width: 100%;">
                        <h4 id="total_earned" style="margin:0 !important">{{ $earned->total_earned }}</h4>
                    </div>
                </div>
                <div class="col" style="padding-left:0px">
                    <div class="totalearned badge badge-danger" style="width: 100%">
                        <h4 id="total_spent" style="margin:0 !important">{{ $spent->total_spent }}</h4>
                    </div>
                </div>
            </div>
            <div>
                <h3>
                    Total Amount Left : <span id="total_left"></span>
                </h3>
                <a href="{{ route('showpocket') }}" style="text-decoration:underline;color:blue;cursor: pointer;">Go
                    back</a>
            </div>
        </div>
    </div>

    <!-- Modal EARNED -->
    <div class="modal fade" id="addearned" tabindex="-1" aria-labelledby="addearnedLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('add.earned',['eventid'=>$events->id]) }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addearnedLabel">Add Earned Amount</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf

                        <div class="form-group row">
                            <label for="earned" class="col-md-4 col-form-label text-md-right">{{ __('Earned Amount') }}</label>
                            <div class="col-md-6">
                                <input id="earned" type="number" class="form-control @error('earned') is-invalid @enderror" name="earned" value="{{ old('earned') }}" required autocomplete="earned" autofocus> @error('earned')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="earned_note" class="col-md-4 col-form-label text-md-right">{{ __('Earned Purpose/Note') }}</label>
                            <div class="col-md-6">
                                <input id="earned_note" type="text" class="form-control @error('earned_note') is-invalid @enderror" name="earned_note" value="{{ old('earned_note') }}" required autocomplete="earned_note" autofocus> @error('earned_note')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span> @enderror
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

    <!-- Modal SPENT -->
    <div class="modal fade" id="addspent" tabindex="-1" aria-labelledby="addspentLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('add.spent',['eventid'=>$events->id]) }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addspentLabel">Add Spent Amount</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf

                        <div class="form-group row">
                            <label for="spent" class="col-md-4 col-form-label text-md-right">{{ __('Spent Amount ') }}</label>
                            <div class="col-md-6">
                                <input id="spent" type="number" class="form-control @error('spent') is-invalid @enderror" name="spent" value="{{ old('spent') }}" required autocomplete="spent" autofocus> @error('spent')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="spent_note" class="col-md-4 col-form-label text-md-right">{{ __('Spent Purpose/note') }}</label>
                            <div class="col-md-6">
                                <input id="spent_note" type="text" class="form-control @error('spent_note') is-invalid @enderror" name="spent_note" value="{{ old('spent_note') }}" required autocomplete="spent_note" autofocus> @error('spent_note')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span> @enderror
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

    @else
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No Such Event <br>
        <a href="{{ route('showpocket') }}" style="text-decoration:underline;color:blue;cursor: pointer;">Go
           back</a>
    </div>
    @endif
</div>
<script type="text/javascript">
    // Selecting the input element and get its value
    var totalearned = document.getElementById("total_earned").innerHTML;

    var totalspent = document.getElementById("total_spent").innerHTML;
    var totaleft = totalearned - totalspent;




    document.getElementById("total_left").innerHTML = totaleft;


    $(document).ready(function() {

        $("#addearnednote").on("click", function(e) {

            $(".addearnednoteform").toggle();
            $(".showearnednote").toggle();

            e.preventDefault();

        });
        $("#addspentnote").on("click", function(e) {

            $(".addspentnoteform").toggle();
            $(".showspentnote").toggle();

            e.preventDefault();

        });


    });
</script>

@endsection
