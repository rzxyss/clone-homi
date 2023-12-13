@extends('page.partials.member')


@section('member_content')
<div class="container">
    <div class="d-flex align-items-start">
        @if ($account->photo != "")
        <img src="{{asset('assets/images/profile/'.$account->photo)}}" alt="" width="100">
        @else
        <img src="https://static.vecteezy.com/system/resources/previews/004/991/321/original/picture-profile-icon-male-icon-human-or-people-sign-and-symbol-vector.jpg"
            alt="" width="100">
        @endif
        <div class="d-flex flex-column">
            <div class="d-flex mx-3 align-items-center">
                <h1 class="mx-1">{{$account->username}}</h1>
                <button class="btn btn-checkout mx-1" style="border-radius: 10px;">Edit Profile</button>
            </div>
            <div class="d-flex mx-3 align-items-center">
                <h1 class="mx-1">0 <span style="font-size: 15px">Produk</span></h1>
                <h1 class="mx-1">{{$followers}} <span style="font-size: 15px">Pengikut</span></h1>
                <h1 class="mx-1">{{$following}} <span style="font-size: 15px">Diikuti</span></h1>
            </div>
        </div>
    </div>
    <br>
    <form action="{{ route('profile.update', auth()->id()) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nama</label>
                    <input name="name" type="text" class="form-control" value="{{$account->name}}"
                        placeholder="Masukan Nama">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input name="email" type="email" class="form-control" value="{{$account->email}}"
                        placeholder="Masukan Email">
                </div>
                <div class="form-group">
                    <label>No Handphone</label>
                    <input name="phone" type="text" class="form-control" value="{{$account->phone}}"
                        placeholder="Masukan No Handphone">
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input name="username" type="text" class="form-control" value="{{$account->username}}" placeholder="Masukan
                                Username">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Masukan Foto</label>
                    <input type="file" class="form-control" name="profile_image">
                </div>
                <div class="row justify-content-center">
                    <img src="https://static.vecteezy.com/system/resources/previews/004/991/321/original/picture-profile-icon-male-icon-human-or-people-sign-and-symbol-vector.jpg"
                        alt="" width="100">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection