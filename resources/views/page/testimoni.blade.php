@extends('page.partials.main')
@push('css')
<style>
    .required-label {
        font-size: 80%;
        color: red;
    }
</style>
@endpush

@section('contents')
<div class="container-fluid pt-4">
    <div class="row pt-2">
        <div class="col-md-6 col-lg-9 d-none d-md-block">
            <div class="card">
                <div class="car-body p-3">
                    <div class="h5 font-weight-bold">Bagikan Pengalaman Anda Bersama Kami</div>
                    <form class="pt-2" action="{{route('testimoni.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="d-flex align-items-start">Nama&nbsp;<small
                                    class="required-label">*required</small></label>
                            <input type="text" name="name" class="form-control" placeholder="Masukan Nama Anda"
                                required>
                        </div>
                        <div class="form-group">
                            <label class="d-flex align-items-start">Email&nbsp;<small
                                    class="required-label">*required</small></label>
                            <input type="email" name="email" class="form-control" placeholder="Masukan Email Anda"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Situs Web Anda</label>
                            <input type="text" class="form-control" name="website"
                                placeholder="Masukan Situs Website Anda">
                        </div>
                        <div class="form-group">
                            <label>Pengalaman Anda</label>
                            <textarea class="form-control" name="testimoni" placeholder="Ceritakan Pengalaman Anda"
                                required></textarea>
                        </div>
                        <button class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 d-md-none">
            <div class="card">
                <div class="car-body p-3">
                    <div class="h5 font-weight-bold">Bagikan Pengalaman Anda Bersama Kami</div>
                    <form class="pt-2" action="{{route('testimoni.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="d-flex align-items-start">Nama&nbsp;<small
                                    class="required-label">*required</small></label>
                            <input type="text" name="name" class="form-control" placeholder="Masukan Nama Anda"
                                required>
                        </div>
                        <div class="form-group">
                            <label class="d-flex align-items-start">Email&nbsp;<small
                                    class="required-label">*required</small></label>
                            <input type="email" name="email" class="form-control" placeholder="Masukan Email Anda"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Situs Web Anda</label>
                            <input type="text" class="form-control" name="website"
                                placeholder="Masukan Situs Website Anda">
                        </div>
                        <div class="form-group">
                            <label>Pengalaman Anda</label>
                            <textarea class="form-control" name="testimoni" placeholder="Ceritakan Pengalaman Anda"
                                required></textarea>
                        </div>
                        <button class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="pt-5">
        <h1 class="text-center">Testimoni</h1>
        <div class="card-columns">
            @foreach ($testimoni as $data)
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title p-0 m-0">{{$data->name}}</h3>
                    <p class="card-text p-0 m-0">{{$data->email}}</p>
                    <p class="card-text p-0 m-0">{{$data->website}}</p>
                    <p class="card-text mt-3 m-0">{!! nl2br($data->testimoni) !!}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

<script>
    function likeToggle(productId) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: `like-toggle/${productId}`, 
            data: {
                '_token' : csrfToken
            },
            success: function (response) {
                if(response.error) {
                    iziToast.error({
                        title: 'Error!',
                        message: response.error,
                        icon: 'fa fa-x fa-sm',
                        closeOnClick: true,
                        position: "topRight",
                    });
                    return false;
                }
                if (response) {
                    $('#likeDivButton'+productId).removeClass('scale-transition');

                    $('#likeDivButton'+productId).addClass('scale-transition');
                    if (response.isLiked == 1) {
                        $('#likeButton'+productId).removeClass('blue-logo').addClass('text-danger');
                        $('#likeIcon'+productId).removeClass('fa-regular').addClass('fa-solid');
                        iziToast.success({
                            title: 'Success!',
                            message: response.success,
                            icon: 'fa fa-check',
                            closeOnClick: true,
                            position: "topRight",
                        });
                    } else {
                        $('#likeButton'+productId).removeClass('text-danger').addClass('blue-logo');
                        $('#likeIcon'+productId).removeClass('fa-solid').addClass('fa-regular');
                        iziToast.info({
                            title: 'Sure?',
                            message: response.success,
                            icon: 'fa fa-circle-info',
                            closeOnClick: true,
                            position: "topRight",
                        });
                    }

                }
            },
            error: function(response) {
                iziToast.error({
                    title: 'Failed',
                    message: response.error,
                    icon: 'fa fa-x',
                    closeOnClick: true,
                    position: "topRight",
                });
            }
        })
    }

    function cartToggle(productId) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: `cart-toggle/${productId}`, 
            data: {
                '_token' : csrfToken
            },
            success: function (response) {
                if(response.error) {
                    iziToast.error({
                        title: 'Error!',
                        message: response.error,
                        icon: 'fa fa-x',
                        closeOnClick: true,
                        position: "topRight",
                    });
                    return false;
                }
                if (response) {
                    $('#cartDivButton'+productId).removeClass('scale-transition');

                    $('#cartDivButton'+productId).addClass('scale-transition');
                    if (response.isCart == 1) {
                        $('#cartIcon'+productId).removeClass('blue-logo').addClass('text-success');
                        iziToast.success({
                            title: 'Success!',
                            message: response.success,
                            icon: 'fa fa-check',
                            closeOnClick: true,
                            position: "topRight",
                        });
                    } else {
                        $('#cartIcon'+productId).removeClass('text-success').addClass('blue-logo');
                        iziToast.info({
                            title: 'Sure?',
                            message: response.success,
                            icon: 'fa fa-circle-info',
                            closeOnClick: true,
                            position: "topRight",
                        });
                    }
                }
            },
            error: function(response) {
                iziToast.error({
                    title: 'Failed',
                    message: response.error,
                    icon: 'fa fa-x',
                    position: "topRight",
                });
            }
        })
    }
</script>