@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header justify-content-between">
        <h1>Vendor {{ $vendor->company_name }}</h1>
        <a href="{{ route('admin.vendors') }}" class="btn btn-primary justify-end"><i class="fa fa-arrow-left"></i> Back</a>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @include('layouts.templates.alert')

                    <table class="table table-bordered" id="datatable" border="1">
                        <tr>
                            <td>Company Name</td>
                            <td>{{ $vendor->company_name }}</td>
                        </tr>
                        <tr>
                            <td>Contact Name</td>
                            <td>{{ $vendor->contact_name }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $vendor->email }}</td>
                        </tr>
                        <tr>
                            <td>Phone Number</td>
                            <td>{{ $vendor->phone_number }}</td>
                        </tr>
                        <tr>
                            <td>Website</td>
                            <td>{{ $vendor->website ?? "-" }}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>{{ $vendor->address }}</td>
                        </tr>
                        <tr>
                            <td>Service Offered Description</td>
                            <td>
                                {!! $vendor->service_offered_description !!}
                            </td>
                        </tr>
                        <tr>
                            <td>Status</td>
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
                        </tr>
                        <tr>
                            <td>Documents</td>
                            <td>
                                @foreach($vendorDocuments as $document)
                                    @php
                                        $explodeExtenstion = explode('.', $document->document_name);
                                    @endphp
                                    <div class="mb-5">
                                        @if($explodeExtenstion[1] == 'jpg' || $explodeExtenstion[1] == 'png' || $explodeExtenstion[1] == 'jpeg' || $explodeExtenstion[1] == 'webp')
                                            <a href="{{ asset('vendor_documents/'.$document->document_name) }}" target="_blank">
                                                <img src="{{ asset('vendor_documents/'.$document->document_name) }}" alt="" width="300" height="300">
                                            </a>
                                        @elseif($explodeExtenstion[1] == 'pdf')
                                            <iframe src="{{ asset('vendor_documents/'.$document->document_name) }}" frameborder="0"></iframe>
                                        @endif
                                    </div>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

