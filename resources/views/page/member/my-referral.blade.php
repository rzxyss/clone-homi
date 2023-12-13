@extends('page.partials.member')

@section('member_content')
<div class="card">
    <div class="card-header">
        <h2>Kode Referral</h2>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start">
            <div class="col-6">
                <div class="d-flex align-items-start">
                    <h3>Kode Referral</h3>
                    <h3>&nbsp;:&nbsp;</h3>
                    <h3>{{$code->code}}</h3>
                </div>
                <div class="d-flex align-items-start">
                    <h3>Status Referral</h3>
                    <h3>&nbsp;:&nbsp;</h3>
                    <h3><span class="text-success">Registrasi Web</span></h3>
                </div>
            </div>
            <div class="justify-content-end">
                <div class="alert alert-secondary" role="alert">
                    {{$isUse}} Pengguna
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3>List Pengguna Kode Referral</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">No Telpon</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @foreach ($users as $data)
                            <tr>
                                <th scope="row">{{$no++}}</th>
                                <td>{{$data->name}}</td>
                                <td>{{$data->email}}</td>
                                <td>{{$data->phone}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection