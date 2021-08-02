<a title="Click to mark as favourite question(click again to undo)"
     class="favourite mt-2 {{ Auth::guest() ? 'off' : ($model->is_favourited ? 'favourited' :'') }}"
     onclick="event.preventDefault();document.getElementById('question-favourite-{{ $model->id }}').submit()" >
        <i class="fas fa-star fa-2x"></i>
        <span class="favourites-count">{{ $model->favourited_count}}</span>
    </a>
    <form action="/{{ $firstUriSegment }}/{{$model->id}}/favourites" id="question-favourite-{{ $model->id}}" method="post" style="display: none">
        @csrf
        @if($model->is_favourited)
            @method('DELETE')
        @endif

    </form>