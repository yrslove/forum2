@extends('layouts.app')

@section('content')
    <thread :initial-replies-count="{{ $thread->replies_count }}" inline-template>
        <div class="container">
            <div class="row">
                <div class="col-md-8 ">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="level">
                           <span><a href="{{ route('profile',$thread->creator) }}">{{ $thread->creator->name }}</a>:posted
                               {{ $thread->title }}
                           </span>
                                @can('update',$thread)
                                    <form method="POST" action="{{ $thread->path()}}">
                                        {{ csrf_field() }}

                                        <button class="btn btn-danger">Delete</button>
                                    </form>
                                @endcan
                            </div>
                        </div>

                        <div class="panel-body">
                            {{ $thread->body }}
                        </div>
                    </div>


                    <replies @added="repliesCount++"
                             @removed="repliesCount--"></replies>

                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <p>
                                This thread was published {{ $thread->created_at->diffForHumans() }} by
                                <a href="#">{{ $thread->creator->name }}</a>, and currently
                                has <span
                                        v-text="repliesCount"></span> {{ str_plural('comment', $thread->replies_count) }}
                                .
                            </p>
                            <subscribe-button :active="{{ json_encode($thread->isSubscribedTo) }}"></subscribe-button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </thread>
@endsection
