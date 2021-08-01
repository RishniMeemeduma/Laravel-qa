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
                            <a title="This question is useful" class="vote-up {{ Auth::guest()?'off':''}}"
                            onclick="event.preventDefault();document.getElementById('question-vote-up-{{$question->id}}').submit()">
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <span class="votes-count">{{ $question->vote_count}}</span>
                            <a title="This question is not usable" class="vote-down off {{ Auth::guest()?'off':''}}" 
                            onclick="event.preventDefault();document.getElementById('question-vote-down-{{ $question->id }}').submit()">
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            <a title="Click to mark as favourite question(click again to undo)"
                             class="favourite mt-2 {{ Auth::guest() ? 'off' : ($question->is_favourited ? 'favourited' :'') }}"
                             onclick="event.preventDefault();document.getElementById('question-favourite-{{ $question->id }}').submit()" >
                                <i class="fas fa-star fa-2x"></i>
                                <span class="favourites-count">{{ $question->favourited_count}}</span>
                            </a>
                            <form action="{{ route('questions.favourites',$question->id)}}" id="question-favourite-{{ $question->id}}" method="post" style="display: none">
                                @csrf
                                @if($question->is_favourited)
                                    @method('DELETE')
                                @endif

                            </form>
                            <form method="POST" action="{{ route('questions.vote',$question->id)}}" id="question-vote-up-{{$question->id}}">
                                @csrf
                                <input type="hidden" name="vote" value="1">
                            </form>

                            <form action="{{ route('questions.vote',$question->id) }}" method="POST" id="question-vote-down-{{ $question->id }}">
                                @csrf
                                <input type="hidden" name="vote" value="-1">
                            </form>
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
