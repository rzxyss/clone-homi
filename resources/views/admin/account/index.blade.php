@extends('admin.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header justify-content-between">
            <div class="d-flex align-items-center justify-content-between">
                <h3>Account</h3>
                <a href="account/create" class="btn btn-outline-dark">Add New</a>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($users as $data)
                    <tr>
                        <td><strong>{{$no}}</strong></td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->email}}</td>
                        <td>{{$data->phone}}</td>
                        <td>
                            @if ($data->role == 'admin')
                            <span class="badge bg-label-info me-1">Admin</span>
                            @else
                            <span class="badge bg-label-primary me-1">Member</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('account.edit', $data->id) }}" class="mx-1"><i
                                        class="bx bx-edit-alt me-1"></i> Edit</a>
                                <a class="mx-1"><i class="bx bx-trash me-1"></i> Delete</a>
                            </div>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection