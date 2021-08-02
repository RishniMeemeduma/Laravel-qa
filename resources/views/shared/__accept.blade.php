@can('accept',$model)
                        <a title="Mark this model as bast model" 
                        class="{{ $model->status }} mt-2 "
                        onclick="event.preventDefault();document.getElementById('accept-model-{{ $model->id }}').submit()">
                            <i class="fas fa-check fa-2x"></i>
                        </a>
                        <form action="{{ route('models.accept',$model->id)}}" id="accept-model-{{ $model->id}}" method="post" style="display: none">
                        @csrf
                        </form>
                        @else
                            @if($model->is_best)
                            <a title="best model" 
                        class="{{ $model->status }} mt-2 " >
                            <i class="fas fa-check fa-2x"></i>
                        </a>
                            @endif
                        @endcan