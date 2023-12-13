@extends('admin.layouts.app')

@section('content')


<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header justify-content-between">
            <div class="d-flex align-items-center justify-content-between">
                <h3>Completed Transaction</h3>
            </div>
        </div>
        <div class="table-responsive text-nowrap px-1">
            <table id="example" class="table">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Customer Name</th>
                        <th>Product Name</th>
                        <th>Payment Bank</th>
                        <th>Payment Proof</th>
                        <th>Status Transaction</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($incoming as $data)
                    <tr>
                        <td><strong>1</strong></td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->product_name}}</td>
                        <td>{{$data->payment_bank}}</td>
                        <td><button class="btn btn-custom" id="open-modal" data-bs-toggle="modal"
                                data-bs-target="#proofModal"><img
                                    src="{{asset('assets/images/proof/'.$data->payment_proof)}}"
                                    data-proof="{{$data->payment_proof}}" height="80"></button>
                        </td>
                        <td>
                            <span class="badge bg-label-success me-1">Success</span>
                        </td>
                    </tr>
                    <div class="modal fade" id="proofModal" tabindex="-1" aria-labelledby="proofModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="proofModalLabel">Payment Proof</h5>
                                </div>
                                <div class="modal-body row justify-content-center">
                                    <img src="{{asset('assets/images/proof/'.$data->payment_proof)}}" alt=""
                                        height="500">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-custom" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection