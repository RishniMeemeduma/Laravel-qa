<div class="media post">
    @include('shared._vote',[
        'model'=>$answer
    ])
    <div class="media-body">
        {!! $answer->body_html !!}

        <div class="row">
            <div class="col-4">
                    {{-- @if(Auth::user()->can('update-question',$answer)) --}}
                    @can('update',$answer)
                    <a href="{{ route('questions.answers.edit',[$question->id,$answer->id])}}" class="btn btn-sm btn-outline-info">Edit</a>
                    @endcan
                    {{-- @if(Auth::user()->can('delete-question',$answer)) --}}
                    @can('delete',$answer)
                    <form class="form-delete" action="{{ route('questions.answers.destroy',[$question->id,$answer->id])}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure ?')">Delete</button>
                    </form>
                    @endcan
            </div>
        
            <div class="col-4"></div>
            <div class="col-4">
                @include('shared.author',[
                    'model'=> $answer,
                    'label' => 'Answered'
                ])
                
            </div>
        </div>
    </div>
</div>