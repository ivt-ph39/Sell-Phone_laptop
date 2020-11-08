@extends('layouts.masterAdmin')
@section('title')
    {{ $titlePage }}
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-selection__choice {
            background-color: #9d5151 !important;
        }

    </style>
@endsection
@section('main')
    <div class="pt-3">
        <h4 class="m-3">{{ $titlePage }}.</h4>
    </div>
    <div class="container">
        <div class="content">
            {{-- <button class="btn btn-sm mt-3 ml-4 btn-outline-primary" onclick="back()"><i
                    class="fas fa-backward"></i> Back on Page</button> --}}
            <div class="row">
                {{-- create blogs --}}
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data" accept="image/*">
                                @csrf
                                @method('PUT')
                                <div class="row form-group">
                                    <div class="col">
                                        <label>Tiêu đề bài viết</label>
                                        <textarea type="text" name="title" class="form-control"
                                            > {{ $blog->title  }}</textarea>
                                        @if ($errors->has('title'))
                                            <span style="color: red">{{ $errors->first('title') }}</span>
                                        @endif
                                    </div>
                                    <div class="col">
                                        <label>Nhập tags</label>
                                        <select class="form-control select2_tags" name="tag[]" multiple="multiple">
                                            @foreach ($blog->blog_tag as $tag)
                                                <option value="{{ $tag->tag }}" selected>{{ $tag->tag }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('tag'))
                                            <span style="color: red">{{ $errors->first('tag') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Nội dung bài viết</label>
                                    <textarea type="text" id="editor1" name="content" class="form-control"
                                        placeholder="Enter content of blog">{{ $blog->content }}</textarea>
                                    @if ($errors->has('content'))
                                        <span style="color: red">{{ $errors->first('content') }}</span>
                                    @endif
                                </div>

                                <div class="form-group custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="switch1" name="status" {{ ($blog->status == 1) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="switch1">Hiển thị nội dung</label>
                                </div>

                                <div class="form-group">
                                    <label>Chọn ảnh thumbnail</label><br>
                                    <img id="blah" width="100" height="100"  style="background-color: rgb(214, 185, 252)" />
                                    <input type="file" value="{{ $blog->thumbnail }}" name="thumbnail"
                                        onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                </div>

                                <hr>
                                <button type="submit" class="btn btn-sm btn-outline-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(function() {
            $('.select2_tags').select2({
                tags: true,
                tokenSeparators: [','],
                placeholder: "Enter tags",
                allowClear: true
            })
        });

    </script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor1'), {
                ckfinder: {
                    // Upload the images to the server using the CKFinder QuickUpload command.
                    uploadUrl: 'editors/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&responseType=json'
                }
            })
            .then(editor => {
                console.log('Editor was initialized', editor);
            })
            .catch(error => {
                console.error(error.stack);
            });

    </script>
@endsection