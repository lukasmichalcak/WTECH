@extends('layouts.app')

@section('title', 'Product List')

@section('content')
    @include('layouts.headers.header_with_search')

    <div class="container-fluid text-center div-with-side-bar">

        <div class="row g-0">

            <div class="col">


{{--                Price filter--}}
                <div class="container border-bottom py-3">
                    <div class="row g-4 row-cols-sm-1 row-cols-md-3 row-cols-xl-6 justify-content-center">
                        <div class="col-2">
                            <button class="form-select rounded-pill fw-bold text-start" data-bs-toggle="modal" data-bs-target="#priceModal">
                                Price
                            </button>


                            <form method="GET" action="{{ route('products.list') }}">


                                <input type="hidden" name="search" value="{{ request('search') }}">
                                <input type="hidden" name="brand" value="{{ request('brand') }}">
                                <input type="hidden" name="minStock" value="{{ request('minStock') }}">
                                <input type="hidden" name="sort" value="{{ request('sort') }}">
                                <input type="hidden" name="type" value="{{ request('type') }}">

                            <div class="modal fade" id="priceModal" tabindex="-1" aria-labelledby="priceModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="priceModalLabel">Filter by Price</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">


                                            <label for="minPrice" class="form-label">Minimum Price</label>
                                            <input type="number" class="form-control mb-3" id="minPrice" name="minPrice" placeholder="e.g. 10" value="{{ request('minPrice') }}">

                                            <label for="maxPrice" class="form-label">Maximum Price</label>
                                            <input type="number" class="form-control" id="maxPrice" name="maxPrice" placeholder="e.g. 100" value="{{ request('maxPrice') }}">



                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type=submit class="btn btn-primary" data-bs-dismiss="modal">Apply</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>


                        </div>

{{--                        Brand Filter--}}
                        <div class="col-2">
                            <form id="brandFilterForm" method="GET" action="{{ route('products.list') }}">

                                <!-- Preserve other filters if they exist -->
                                <input type="hidden" name="search" value="{{ request('search') }}">
                                <input type="hidden" name="minPrice" value="{{ request('minPrice') }}">
                                <input type="hidden" name="maxPrice" value="{{ request('maxPrice') }}">
                                <input type="hidden" name="minStock" value="{{ request('minStock') }}">
                                <input type="hidden" name="sort" value="{{ request('sort') }}">
                                <input type="hidden" name="type" value="{{ request('type') }}">

                                <select class="form-select rounded-pill fw-bold" name="brand" aria-label="Filter by Brand" onchange="this.form.submit()">
                                    <option value="" {{ !request('brand') ? 'selected' : '' }}>All Brands</option>
                                    @forelse ($brands as $brand)
                                        <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                                    @empty
                                        <option value="">No brands available</option>
                                    @endforelse
                                </select>
                            </form>
                        </div>



{{--                        Stock filter--}}
                        <div class="col-2">
                            <button class="form-select rounded-pill fw-bold text-start" data-bs-toggle="modal" data-bs-target="#stockModal">
                                Stock
                            </button>

                            <form method="GET" action="{{ route('products.list') }}">


                                <input type="hidden" name="search" value="{{ request('search') }}">
                                <input type="hidden" name="brand" value="{{ request('brand') }}">
                                <input type="hidden" name="minPrice" value="{{ request('minPrice') }}">
                                <input type="hidden" name="maxPrice" value="{{ request('maxPrice') }}">
                                <input type="hidden" name="sort" value="{{ request('sort') }}">
                                <input type="hidden" name="type" value="{{ request('type') }}">


                                <div class="modal fade" id="stockModal" tabindex="-1" aria-labelledby="stockModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content rounded-4">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="stockModalLabel">Filter by stock</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">


                                                <label for="minStock" class="form-label">Minimum Stock</label>
                                                <input type="number" class="form-control mb-3" id="minStock" name="minStock" placeholder="e.g. 5" value="{{ request('minStock') }}">


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type=submit class="btn btn-primary" data-bs-dismiss="modal">Apply</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>

                        <div class="col-2">

                            <form id="SortingFilterForm" method="GET" action="{{ route('products.list') }}">
                                <input type="hidden" name="search" value="{{ request('search') }}">
                                <input type="hidden" name="brand" value="{{ request('brand') }}">
                                <input type="hidden" name="minPrice" value="{{ request('minPrice') }}">
                                <input type="hidden" name="maxPrice" value="{{ request('maxPrice') }}">
                                <input type="hidden" name="minStock" value="{{ request('minStock') }}">
                                <input type="hidden" name="type" value="{{ request('type') }}">



                                <select class="form-select rounded-pill fw-bold" name="sort" aria-label="Sort items" onchange="this.form.submit()">
                                    <option value="" {{ !request('sort') ? 'selected' : '' }}>Sort</option>
                                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>A-Z</option>
                                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Z-A</option>
                                </select>


                            </form>
                        </div>

                        </div>
                    </div>
                </div>



                <div class="row g-0" style="padding: 0">
                    <div class="col-12 p-3" style="background-color: white">
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">


                            @forelse ($products as $product)
                                <div class="col">
                                    <a href="{{ url('/product/' . $product->id) }}" class="text-decoration-none text-reset">
                                    <div class="card align-items-center h-100">
                                        <img src="{{ Vite::asset('resources/images/GeneratedTV.jpg') }}" class="card-img-top card-img" alt="a55" style="width: 200px; height: auto;">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $product->name }}</h5>
                                        </div>
                                        <div class="card-body">
                                            <p>{{ $product->price }}$</p>
                                            <a href="#" class="card-link"><i class="bi bi-cart-plus"></i></a>
                                        </div>
                                    </div>
                                    </a>
                                </div>

                            @empty
                                <div class="col-12">
                                    <p>No products available.</p>
                                </div>
                            @endforelse


                        </div>
                    </div>
                </div>


            </div>
            <nav aria-label="Pagination">
                <ul class="pagination justify-content-end me-3" id="pagination">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    @php
//                        $currentSearch = request('search'); // get current search if presenta
                     // Get all current request parameters except 'page'
                        $queryParams = request()->all();
                        // Remove 'page' from the parameters if it exists
                            if (isset($queryParams['page'])) {
                                unset($queryParams['page']);
                            }
                    @endphp

                    @for ($i = 1; $i <= 7; $i++)
{{--                        <li class="page-item">--}}
{{--                            <a class="page-link" href="{{ route('products.list', ['page' => $i, 'search' => $currentSearch]) }}">{{ $i }}</a>--}}
{{--                        </li>--}}

                        <li class="page-item {{ request()->input('page', 1) == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ route('products.list', array_merge($queryParams, ['page' => $i])) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>

                </ul>
            </nav>

        </div>

    @include('layouts.footers.footer')
@endsection



