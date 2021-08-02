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
                        @include('shared._vote',[
                            'model'=>$question
                        ])
                        <div class="media-body">
                            {!! $question->body_html !!}
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-4"></div>
                            <div class="col-4">
                           @include('shared.author',[
                               'model'=>$question,
                               'label'=>'asked'
                           ])
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
