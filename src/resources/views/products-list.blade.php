@extends('layouts.app')

@section('title', 'Product List')

@section('content')
    @include('layouts.headers.header_with_search')

    <div class="container-fluid text-center div-with-side-bar">

        <div class="row g-0">

            <div class="col">
                <div class="container border-bottom py-3">
                    <div class="row g-4 row-cols-sm-1 row-cols-md-3 row-cols-xl-6 justify-content-center">
                        <div class="col-2">
                            <button class="form-select rounded-pill fw-bold text-start" data-bs-toggle="modal" data-bs-target="#priceModal">
                                Price
                            </button>


                            <form method="GET" action="{{ route('products.list') }}">
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

                                            <input type="hidden" name="search" value="{{ request('search') }}">

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
                            <form id="brandFilterForm" method="GET" action="{{ route('products.list') }}">

                                <!-- Preserve other filters if they exist -->
                                <input type="hidden" name="search" value="{{ request('search') }}">
                                <input type="hidden" name="minPrice" value="{{ request('minPrice') }}">
                                <input type="hidden" name="maxPrice" value="{{ request('maxPrice') }}">

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

                        <div class="col-2">
                            <button class="form-select rounded-pill fw-bold text-start" data-bs-toggle="modal" data-bs-target="#tagsModal">
                                Tags
                            </button>
                            <div class="modal fade" id="tagsModal" tabindex="-1" aria-labelledby="tagsModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="tagsModalLabel">Add Tags</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <!-- Tag Input -->
                                            <div class="input-group mb-3">
                                                <label for="tagInput"></label><input type="text" id="tagInput" class="form-control" placeholder="Enter a tag">
                                                <button class="btn btn-outline-primary" id="addTagButton" type="button">Add</button>
                                            </div>

                                            <!-- Tag List -->
                                            <div class="mt-4">
                                                <h6 class="mb-2">Selected Tags:</h6>
                                                <div id="tagList" class="d-flex flex-wrap gap-2">
                                                    <!-- Tags will appear here -->
                                                </div>
                                            </div>

                                            <!-- Available tags-->
                                            <div class="mt-4">
                                                <h6 class="mb-2">Suggested Tags:</h6>
                                                <div id="suggestedTags" class="d-flex flex-wrap gap-2">
                                                    <!-- Tags will be inserted here -->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Apply</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-2">
                            <select class="form-select rounded-pill fw-bold" aria-label="Filter by Colour">
                                <option value="" disabled selected hidden>Color</option>
                                <option value="Color 1">Color 1</option>
                                <option value="Color 2">Color 2</option>
                                <option value="Color 3">Color 3</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <select class="form-select rounded-pill fw-bold" aria-label="Filter by Availability">
                                <option value="" disabled selected hidden>Availability</option>
                                <option value="In stock">In stock</option>
                                <option value="All">All</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <select class="form-select rounded-pill fw-bold" aria-label="Sort items">
                                <option value="" disabled selected hidden>Sort</option>
                                <option value="A-Z">A-Z</option>
                                <option value="Z-A">Z-A</option>
                                <option value="Newest">Newest</option>
                                <option value="Oldest">Oldest</option>
                            </select>
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
                        $currentSearch = request('search'); // get current search if present
                    @endphp

                    @for ($i = 1; $i <= 7; $i++)
                        <li class="page-item">
                            <a class="page-link" href="{{ route('products.list', ['page' => $i, 'search' => $currentSearch]) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>

        </div>
    </div>


    @include('layouts.footers.footer')
@endsection



