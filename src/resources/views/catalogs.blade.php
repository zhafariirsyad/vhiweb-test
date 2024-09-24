<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title')</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.2.0/ekko-lightbox.min.css" rel="stylesheet" />

</head>

<body>
<div id="app">
    <div class="main-wrapper">
        {{-- @include('layouts.templates.navbar')

        @include('layouts.templates.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>

        @include('layouts.templates.footer') --}}
        <form id="searchForm" class="form-inline my-2 my-lg-0 justify-content-end">
            <div class="input-group">
                <input type="text" id="searchInput" name="search" class="form-control" placeholder="Search catalog by name or category">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </div>
            </div>
        </form>

        <div id="preloader" style="display:none;">
            Loading...
        </div>

        <h2 class="section-title text-white">See our Catalogs</h2>
        <div id="productResults" class="row">
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
                            <p>
                                {!! Str::words($product->description, 100, '...') !!}
                            </p>
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
        </div>
    </div>
</div>

<!-- General JS Scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.2.0/ekko-lightbox.min.js"></script>

<!-- Template JS File -->
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

@yield('js')

<script>
    $(document).ready(function() {
        $('#searchForm').on('submit', function(event) {
            event.preventDefault();

            let searchQuery = $('#searchInput').val();

            $('#preloader').show();

            $.ajax({
                url: '{{ route("products.search") }}',
                method: 'GET',
                data: {
                    search: searchQuery
                },
                success: function(response) {
                    $('#preloader').hide();

                    $('#productResults').html(response);
                },
                error: function() {
                    $('#preloader').hide();
                    alert('Error fetching data.');
                }
            });
        });
    });
</script>

<!-- Page Specific JS File -->
</body>
</html>
