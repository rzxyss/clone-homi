@extends('admin.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detail Blog</h5>
            <a href="/admin/blog" class="btn btn-danger float-end">Back</a>
        </div>
        <div class="card-body">
            <h3 class="text-center">{{$blog->title}}</h3>
            <div class="container">
                <div class="text-center">
                    <img src="{{asset('assets/images/thumbnail/'.$blog->thumbnail)}}" class="img-fluid" alt="">
                </div>
                <p class="pt-1">Author : {{$blog->name}}</p>
            </div>
            {{-- <div class="d-flex flex-column align-items-center">
            </div> --}}
            <h5>
                {!! nl2br($blog->body) !!}
            </h5>
        </div>
    </div>
</div>
@endsection