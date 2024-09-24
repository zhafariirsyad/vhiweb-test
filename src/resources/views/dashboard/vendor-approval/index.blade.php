@extends('layouts.main')

@section('content')
<style>
    .modal-backdrop {
        display: none;
    }
</style>
<section class="section">
    <div class="section-header">
        <h1>{{ count($vendors) }} Vendor</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @include('layouts.templates.alert')
                    <div class="table-responsive">
                        <table class="table table-striped" id="datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Company Name</th>
                                    <th>Contact Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vendors as $vendor)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $vendor->company_name }}</td>
                                        <td>{{ $vendor->contact_name }}</td>
                                        <td>{{ $vendor->email }}</td>
                                        <td>{{ $vendor->phone_number }}</td>
                                        <td>
                                            @if($vendor->status)
                                                @php
                                                    $statusEnum = App\Enums\VendorStatus::from($vendor->status);
                                                @endphp
                                                <span class="badge {{ $statusEnum->badgeClass() }}">{{ $statusEnum->label() }}</span>
                                            @else
                                                <span class="badge badge-dark">Unknown</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="javascript:void(0)" class="btn btn-primary btn-sm"
                                                data-toggle="modal" data-target="#approvalModal">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                                <a href="{{ route('admin.vendor.show',$vendor->id) }}" class="btn btn-success btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="approvalModal" tabindex="-1" aria-labelledby="approvalModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('admin.vendor.update', $vendor->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="approvalModalLabel">Update Status</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="status">Select Status</label>
                                            <select class="form-control" id="status" name="status">
                                                @foreach(App\Enums\VendorStatus::cases() as $status)
                                                    <option value="{{ $status->value }}"
                                                        {{ $vendor->status === $status->value ? 'selected' : '' }}>
                                                        {{ ucfirst(str_replace('_', ' ', $status->value)) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- <div class="form-group">
                                            <label for="comments">Comments</label>
                                            <textarea class="form-control" id="comments" name="comments" rows="3"></textarea>
                                        </div> --}}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>
@endsection

