@extends('layouts.app')
{{--
<link rel="stylesheet" type="text/css" href="{{ asset('css/addnewnote.css') }}"> --}}
<style>
    .required {
        color: red;
    }

</style>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card  ">
                <div class="card-header">{{ __('ADD NOTE') }}</div>

                <div class="card-body">
                    @if(Session::has('success'))
                        <div class="alert alert-success ">

                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {!! Session::get('success') !!}

                        </div>
                    @endif

                    @error('checkforlist')
                        <div class="alert alert-danger col-md-9 fade-messageinputerror ">
                            <strong> Please Select The Type of Note.</strong>
                        </div>
                    @enderror
                    @error('paranotedata')
                        <div class="alert alert-danger col-md-9 fade-messageinputerror">
                            <strong> There was an error in data you entered, Please check the following:<ul>
                                    <li>The length of the data enter in more than 255.</li>
                                    <li>No data is entered.</li>
                                </ul></strong>
                        </div>
                    @enderror

                    @error('notedata.*')
                        <div class="alert alert-danger col-md-9 fade-messageinputerror">
                            <strong> There was an error in data you entered, Please check the following:<ul>
                                    <li>The length of the data enter in more than 255.</li>
                                    <li>No data is entered.</li>
                                </ul></strong>
                        </div>
                    @enderror



                    <form method="get" action="{{ route('updatenote',$notedata->id) }}">
                        <div class="form-group row ">
                            <div class="col-md-3" style="font-size: 20px;padding:0;text-align:center">
                                <label for="topic">Heading <span class="required">*</span>:</label>
                            </div>
                            <div class="col-md-8" style="padding:0">
                                <input type="text" class="form-control" name="topic" value="{{ $notedata->topic }}">
                            </div>
                            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                        </div>
                        @if($notedata->typeofnote == 'list')
                            <div class="form-group row">
                                <div class="col-md-8">
                                    <div id="dynamicInput">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <label for="topic">Please Enter Your Data to be Added</label><br>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col" style="padding: 5px">
                                                <input type="button" class="btn btn-primary " value="Add New Data Box"
                                                    onClick="addInput('inputlist');">

                                            </div>
                                            <div class="col " style="padding: 5px">
                                                <input type="button" class="btn btn-danger " id="delbtn"
                                                    value="Delete Last Data box" onClick="delInput('dynamicInput');">

                                            </div>
                                        </div>


                                        <ul id="inputlist">
                                            @foreach(unserialize($notedata->note_data) as $mynote)

                                                <li>
                                                    <input type="text" class="form-control" name="notedata[]"
                                                        value="{{ $mynote }}">
                                                </li>

                                            @endforeach
                                        </ul>


                                    </div>

                                </div>

                            </div>
                        @else
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <div id="parainput">

                                        <label for="paranotedata">YOUR DATA <span class="required">*</span></label>

                                        <textarea type="text" class="form-control " name="paranotedata"
                                            autofocus>{{ $notedata->note_data }}</textarea>

                                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">

                                <button type="submit" class="btn btn-primary">Update Data</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
