@extends('admin.layouts.app')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header justify-content-between">
            <div class="d-flex align-items-center justify-content-between">
                <h3>Incoming Transaction</h3>
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
                        <th>Actions</th>
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
                        <td><button class="btn btn-custom open-proof" data-proof="{{$data->payment_proof}}"><img
                                    src="{{asset('assets/images/proof/'.$data->payment_proof)}}" height="80"></button>
                        </td>
                        <td>
                            @if ($data->status == 0)
                            <span class="badge bg-label-warning me-1">Need Approve</span>
                            @else
                            <span class="badge bg-label-success me-1">Prosess</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex">
                                <form action="{{route('transaction.accept', $data->id_transaction)}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-custom mx-1"><i
                                            class="bx bx-check me-1"></i>Accept</button>
                                </form>
                                <button data-id="{{$data->id}}" class="btn btn-custom mx-1 open-decline"><i
                                        class="bx bx-x me-1"></i>Reject</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="proofModal" tabindex="-1" aria-labelledby="proofModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="proofModalLabel">Payment Proof</h5>
            </div>
            <div class="modal-body row justify-content-center" id="proof-content">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-custom" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deniedModal" tabindex="-1" aria-labelledby="proofModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="proofModalLabel">Denied Transaction</h5>
            </div>
            <form id="formDenied" method="POST">
                <div class="modal-body row justify-content-center">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Alasan Menolak Transaksi</label>
                        <input type="text" name="alasan" id="input_alasan" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-custom" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.open-proof').click(function(){
            var img = $(this).data('proof');
            var imgPath = '/assets/images/proof/' + img;
            $('#proofModal').modal('show');
            $('#proof-content').html('<img src="'+ imgPath +'" alt="" height="500" class="img-fluid">');
        })
        $('.open-decline').click(function(){
            var id = $(this).data('id');
            $('#deniedModal').modal('show');
            $('#formDenied').attr('action', '/admin/denied-transaction/' + id);
        })
    });

</script>
@endsection