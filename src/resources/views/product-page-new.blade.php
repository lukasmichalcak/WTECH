@extends('layouts.app')

@section('title', 'Product Page')

@section('content')
    @include('layouts.headers.header_with_search')


    <!-- Split Content Areaa -->
    <div class="container mt-3">
        <div class="row">

            <!-- Right Section (50% or 6/12)aaa -->
            <div class="col-md-5 content-section">

                <form method="POST" action="{{ route('product-new.create') }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <h2>Product name</h2>
                    <input type="text" id="product-name" name="name" class="form-control" placeholder="enter name" required>


                    <h3>Product type</h3>
                    <input type="text" id="product-type" name="type" class="form-control" placeholder="enter type" required>

                    <h3>Product subtype</h3>
                    <input type="text" id="product-subtype" name="subtype" class="form-control" placeholder="enter type" required>

                    <!-- Brand buttons -->
                    <div class="mb-3">
                        <label for="product-brand" class="form-label">Brand:</label>
                        <select id="product-brand" name="brand" class="form-control" required>
                            @foreach($brands as $brand)
                                <option value="{{ $brand }}">
                                    {{ $brand }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Description -->
                    <h2>Product description</h2>
                    <textarea id="product-description" name="description" class="form-control" rows="6" required>Write Product description</textarea>

                    <!-- Price -->
                    <div class="mb-3 mt-5">
                        <label for="product-price" class="form-label">Price ($):</label>
                        <input
                            type="number"
                            id="product-price"
                            name="price"
                            class="form-control no-spinners"
                            value="0.00"
                            step="0.01"
                            min="0"
                            required
                        >
                    </div>

                    <!-- Number in stock -->
                    <div class="mb-3 mt-3">
                        <label for="product-stock" class="form-label">Stocks left:</label>
                        <input
                            type="number"
                            id="product-stock"
                            name="stock"
                            class="form-control no-spinners"
                            value="0"
                            step="1"
                            min="0"
                            required
                        >

                    </div>



                    <!-- Uploading multiple images -->
                    <div class="mb-3 mt-4">
                        <label for="product-images" class="form-label">Upload new images:</label>
                        <input type="file" class="form-control" id="product-images" name="images[]" accept="image/*" multiple>
                    </div>


                    <!-- Button for uploading -->
                    <button type="submit" class="btn btn-primary mt-4">💾 Add new product</button>
                </form>

            </div>
        </div>
    </div>

    @include('layouts.footers.footer')


@endsection
