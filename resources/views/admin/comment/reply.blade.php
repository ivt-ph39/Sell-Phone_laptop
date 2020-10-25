@extends('layouts.masterAdmin')
@section('title')
    {{ $titlePage }}
@endsection
@section('main')
    <div class="pt-3">
        <h4 class="m-3">{{ $titlePage }}.</h4>
    </div>
    <div class="container">
        <div class="content">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.comment.reply', $comment->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            User : <span class="badge badge-info">{{ $comment->name }}</span>
                            <textarea class="form-control" rows="3" disabled>{{ $comment->content }}</textarea>
                        </div>
                        <div>
                            Admin : <span class="badge badge-warning">{{ Auth::user()->name }}</span>
                            <textarea class="form-control" name="content" cols="30" rows="3"></textarea>
                        </div>
                        <hr>
                        <input type="submit" class="btn btn-primary" value="Send">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
