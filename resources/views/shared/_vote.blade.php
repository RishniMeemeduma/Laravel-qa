@if($model instanceOf App\Models\Question)
    @php
        $name='question';
        $firstUriSegment = 'questions';
    @endphp
@else
    @php
        $name='answer';
        $firstUriSegment = 'answers';
    @endphp
@endif

<div class="d-flex flex-column vote-controls">
    <a title="This {{ $name }} is useful" class="vote-up {{ Auth::guest()?'off':''}}"
    onclick="event.preventDefault();document.getElementById('{{ $name }}-vote-up-{{$model->id}}').submit()">
        <i class="fas fa-caret-up fa-3x"></i>
    </a>
    <span class="votes-count">{{ $model->vote_count}}</span>
    <a title="This {{ $name }} is not usable" class="vote-down off {{ Auth::guest()?'off':''}}" 
    onclick="event.preventDefault();document.getElementById('{{ $name }}-vote-down-{{ $model->id }}').submit()">
        <i class="fas fa-caret-down fa-3x"></i>
    </a>
    @if($model instanceof App\Models\Question)
        @include('shared._favourite',[
            'model'=>$model
        ])
        @elseif($model instanceof App\Models\Answer)
        @include('shared.__accept',[
            'model'=>$model
        ])
    @endif
    <form method="POST" action="/{{$firstUriSegment}}/{{$model->id}}/vote" id="{{$name }}-vote-up-{{$model->id}}">
        @csrf
        <input type="hidden" name="vote" value="1">
    </form>

    <form action="/{{ $firstUriSegment}}/{{$model->id }}/vote" method="POST" id="{{$name }}-vote-down-{{ $model->id }}">
        @csrf
        <input type="hidden" name="vote" value="-1">
    </form>
</div>