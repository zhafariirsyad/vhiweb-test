@extends('layouts.main')

@section('content')
<style>
    .modal-backdrop {
        display: none;
    }
</style>
<section class="section">
    <div class="section-header justify-content-between">
        <h1>{{ count($products) }} Products</h1>
        <a href="{{ route('vendor.products.create') }}" class="btn btn-primary">Add New Product</a>
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
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($product->image)
                                                <img src="{{ asset('products/'.$product->image) }}" alt="Product Image" width="50" height="50">
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->getCategory ? $product->getCategory->name : "-" }}</td>
                                        <td>{{ number_format($product->price, 2) }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>
                                            @if($product->status == 'publish')
                                                <span class="badge badge-success">{{ ucfirst($product->status) }}</span>
                                            @else
                                                <span class="badge badge-warning">{{ ucfirst($product->status) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('vendor.products.edit', $product->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                                <a href="{{ route('vendor.products.destroy', $product->id) }}" class="btn btn-danger btn-delete" data-id="{{ $product->id }}"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
<script type="text/javascript">
    $(function() {
        $('.btn-delete').click(function(e) {
            e.preventDefault();
            const href = $(this).attr('href');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = href;
                }
            })
        });
    });
</script>
@endsection

