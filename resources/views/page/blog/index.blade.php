@extends('page.partials.main')

@section('contents')
<div class="container-fluid py-4">
    <h1 class="text-center">Blog</h1>
    <div class="row mt-2">
        @foreach ($blog as $data)
        <div class="col-md-3 d-flex justify-content-center mb-4">
            <a href="{{route('blog.detail', $data->id)}}">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="{{asset('assets/images/thumbnail/'.$data->thumbnail)}}"
                        alt="{{$data->title}}">
                    <div class="card-body">
                        <h3 class="card-title p-0 m-0">{{$data->title}}</h3>
                        <p class="card-text p-0 m-0"><i class="fa fa-user-o">&nbsp;</i>{{$data->name}}</p>
                        <p class="card-text p-0 m-0">{{substr($data->body, 0, 100) . (strlen($data->body) > 100 ? '...'
                            :
                            '')}}</p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection