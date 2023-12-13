@extends('page.partials.main')

@section('contents')
<div class="container py-4">
    <h1 style="font-size: 30px">{{$blog->title}}</h1>
    <p class="p-0 m-0"><span style="font-weight: bold">Homi Desain</span> -
        {{ preg_replace('/\s+/', ', ',
        \Carbon\Carbon::parse($blog->created_at)->setTimezone('Asia/Jakarta')->format('d/m/Y
        H:i'))}} WIB</p>
    <div class="d-flex justify-content-center mt-2">
        <img class="w-100 img-fluid" src="{{asset('assets/images/thumbnail/'.$blog->thumbnail)}}" alt="">
    </div>
    <p class="p-0 m-0 mt-2 mb-3"><i class="fa fa-user-o"></i>&nbsp;{{$blog->name}}</p>
    <h4>
        {!! nl2br($blog->body) !!}
    </h4>
</div>
@endsection