<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
@foreach($products as $product)
    <div class="col-12 col-md-4 col-lg-4">
        <article class="article article-style-c">
            <div class="article-header">
                <div class="article-image" data-background="{{ asset('products/'.$product->image) }}"></div>
            </div>
            <div class="article-details">
                <div class="article-category">
                    <a href="#">{{ $product->getCategory->name }}</a> <div class="bullet"></div> <a href="#">{{ $product->vendor->company_name }}</a>
                </div>
                <div class="article-title">
                    <h2><a href="#">{{ $product->name }} ({{ $product->brand }})</a></h2>
                </div>
                <p>{!! Str::words($product->description, 100, '...') !!}</p>
                <div class="article-user">
                    <div class="article-user-details">
                        <div class="user-detail-name">
                            <a href="#">Rp{{ $product->price }}</a>
                        </div>
                        <div class="text-job">Stock : {{ $product->stock }}</div>
                        <div class="text-job">Weight : {{ $product->weight }}</div>
                    </div>
                </div>
            </div>
        </article>
    </div>
@endforeach
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>
