@extends('admin.layouts.app')

@section('content')


<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header justify-content-between">
            <div class="d-flex align-items-center justify-content-between">
                <h3>Sub Category</h3>
                <a href="subcategory/create" class="btn btn-outline-dark">Add New</a>
            </div>
        </div>
        <div class="table-responsive text-nowrap px-1">
            <table id="example" class="table">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Sub Category Name</th>
                        <th>Category Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($subcategories as $data)
                    <tr>
                        <td><strong>{{$no++}}</strong></td>
                        <td>{{ $data->subcategory_name }}</td>
                        <td>{{ $data->category_name }}</td>
                        <td>
                            <div class="d-flex">
                                <form action="{{ route('subcategory.destroy', $data->id) }}" method="post">
                                    <a href="{{ route('subcategory.edit', $data->id) }}" class="mx-1"><i
                                            class="bx bx-edit-alt me-1"></i> Edit</a>

                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-custom mx-1"><i class="bx bx-trash me-1"></i>
                                        Delete</button>
                                </form>
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