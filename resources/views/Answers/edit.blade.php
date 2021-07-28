@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h1>Editing answers for Question {{ $question->title}}</h1>
                    </div>
                    <hr>
                    <form action="{{ route('questions.answers.update',[$question->id,$answer->id])}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <textarea name="body" class="form-control {{$errors->has('body')?'is-invalid':''}}" cols="30" rows="10" >{{ old('body',$answer->body)}}</textarea>
                            @if($errors->has('body'))
                            <div class="invalid-feedback">
                                {{ $errors->first('body')}}
                            </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-outline-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection