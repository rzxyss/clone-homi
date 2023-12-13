@extends('admin.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header justify-content-between">
            <div class="d-flex align-items-center justify-content-between">
                <h3>Blog List</h3>
                <a href="blog/create" class="btn btn-outline-dark">New Blog</a>
            </div>
        </div>
        <div class="table-responsive text-nowrap px-1">
            <table id="example" class="table">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Thumbnail</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($blog as $data)
                    <tr>
                        <td><strong>{{$no++}}</strong></td>
                        <td>
                            <img src="{{ asset('assets/images/thumbnail/'.$data->thumbnail) }}" height="80" />
                        </td>
                        <td>{{ $data->title }}</td>
                        <td>{{ $data->name }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <form action="{{ route('blog.destroy', $data->id) }}" method="post">
                                    <a href="{{ route('blog.show', $data->id) }}" class="mx-1"><i
                                            class="bx bx-show"></i> Detail</a>
                                    <a href="{{ route('blog.edit', $data->id) }}" class="mx-1"><i
                                            class="bx bx-edit-alt me-1"></i> Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-custom"><i class="bx bx-trash me-1"></i>
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