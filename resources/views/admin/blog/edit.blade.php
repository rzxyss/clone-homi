@extends('admin.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Edit Blog</h5>
            <a href="/admin/blog" class="btn btn-danger float-end">Cancel</a>
        </div>
        <div class="card-body">
            <form action="{{ url('admin/blog', $blog->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" value="{{old('title', $blog->title)}}" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Content</label>
                    <textarea name="body" class="form-control">{{old('body', $blog->body)}}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Thumbnail</label>
                    <input type="file" name="thumbnail" id="image" class="form-control" onchange="previewImage()">
                </div>
                <div class="mb-3">
                    <img src="{{asset('assets/images/thumbnail/'.$blog->thumbnail)}}" alt="Preview" id="imagePreview"
                        style="max-width: 300px; margin-top: 10px;">
                </div>
                <button type="submit" class="btn btn-success">Save</button>
            </form>
        </div>
    </div>
</div>
<script>
    function previewImage() {
        var input = document.getElementById('image');
        var preview = document.getElementById('imagePreview');
  
        if (input.files && input.files[0]) {
            var reader = new FileReader();
  
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
  
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection