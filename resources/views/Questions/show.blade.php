@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h2>{{ $question->title }}</h2>
                            <div class="ml-auto">
                                <a href="{{ route('questions.index')}}" class="btn btn-outline-secondary">Back to All Questions</a>
                            </div>
                        </div>
                        <hr>
                    
                    </div>
    
                    <div class="media">
                        <div class="d-flex flex-column vote-controls">
                            <a title="This question is useful" class="vote-up">
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <span class="votes-count">5</span>
                            <a title="This question is not usable" class="vote-down off" >
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            <a title="Click to mark as favourite question(click again to undo)" class="favourite mt-2 favourited">
                                <i class="fas fa-star fa-2x"></i>
                                <span class="favourites-count">123</span>
                            </a>
                        </div>
                        <div class="media-body">
                            {!! $question->body_html !!}
                        <div class="float-right">
                            <span class="text-muted">
                                {{ $question->created_date }}
                            </span>
                            <div class="media mt-2">
                                <a href="{{ $question->user->url }}" class="pr-2">
                                    <img src="{{ $question->user->avatar}}" alt="">
                                </a>
                                <div class="media-body mt-1">
                                    <a href="{{ $question->user->url }}"> {{ $question->user->name }}</a>
                                </div>
                            </div>
                            
                        </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include ('answers.__index',[
        'answersCount'=> $question->answers_count,
        'answers' => $question->answers,
    ])

    @include('Answers.__create')

</div>
@endsection
