@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header justify-content-between">
        <h1>Add New Product</h1>
        <a href="{{ route('vendor.products.index') }}" class="btn btn-primary justify-end"><i class="fa fa-arrow-left"></i> Back</a>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('vendor.products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ old('name',$product->name) }}" required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select name="category" class="form-control" id="category" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" name="price" step="0.01" class="form-control" id="price" value="{{ old('price',$product->price) }}" required>
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" name="stock" class="form-control" id="stock" value="{{ old('stock',$product->stock) }}" required>
                            @error('stock')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="weight" class="form-label">Weight</label>
                            <input type="text" name="weight" class="form-control" id="weight" value="{{ old('weight',$product->weight) }}" required>
                            @error('weight')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="brand" class="form-label">Brand</label>
                            <input type="text" name="brand" class="form-control" id="brand" value="{{ old('brand',$product->brand) }}" required>
                            @error('brand')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="tinymce" cols="30" rows="10">{{ old('description',$product->description) }}</textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-control" id="status" required>
                                <option value="publish" {{ old('status',$product->status) == 'publish' ? 'selected' : '' }}>Publish</option>
                                <option value="draft" {{ old('status',$product->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                            </select>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Product Image</label>
                            <input id="file-documents" type="file" name="image" class="file" multiple=false data-preview-file-type="any">
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <div class="row mt-4">
                                <div class="col-lg-2 col-xs-12 col-sm-6 col-md-2">
                                    Current Image
                                </div>
                                <div class="col-10">
                                    <div class="row">
                                        <div class="col-lg-3 col-xs-12 col-sm-6 col-md-3" style="margin-bottom:30px;">
                                            <img src="{{ asset('products/'.$product->image) }}" class="img-fluid" alt="Product Image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('vendor.products.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
    <script>
        tinymce.init({
            selector: 'textarea.tinymce',
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            toolbar_mode: 'floating',
            content_style: 'body { font-family:Montserrat; font-size:14px }'
        });

        $("#file-documents").fileinput({
            showUpload:false,
            showRemove:true,
            allowedFileTypes:'image',
            allowedFileExtensions:['png','jpg','jpeg','jfif','webp','docx','doc','pdf'],
        });
    </script>
@endsection
