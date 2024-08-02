@extends('app')
@section('content')
    <div class="d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row">
                <div class="col">
                    <form action="{{ route('post.update', ['id' => $post->id]) }}" method="post">
                        @method('put')
                        @csrf
                        <div class="row mb-2">
                            <div class="col">
                                <label for="">title</label>
                                <input type="text" name="title" class="form-control" value="{{ $post->title }}" id="">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <label for="">Content</label>
                                <textarea id="editor" cols="30" rows="10" name="content" rows="3">{!! $post->content !!}</textarea>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <label for="">Date</label>
                                <input type="date" name="date" class="form-control" id="" value="{{ $post->date }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
