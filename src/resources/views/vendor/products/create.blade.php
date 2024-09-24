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
                    <form action="{{ route('vendor.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select name="category" class="form-control" id="category" required>
                                <option value="" selected disabled>--Choose Category--</option>
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
                            <input type="number" name="price" step="0.01" class="form-control" id="price" value="{{ old('price') }}" required>
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" name="stock" class="form-control" id="stock" value="{{ old('stock') }}" required>
                            @error('stock')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="weight" class="form-label">Weight</label>
                            <input type="text" name="weight" class="form-control" id="weight" value="{{ old('weight') }}" required>
                            @error('weight')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="brand" class="form-label">Brand</label>
                            <input type="text" name="brand" class="form-control" id="brand" value="{{ old('brand') }}" required>
                            @error('brand')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="tinymce" cols="30" rows="10">{{ old('description') }}</textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-control" id="status" required>
                                <option value="publish" {{ old('status') == 'publish' ? 'selected' : '' }}>Publish</option>
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
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
