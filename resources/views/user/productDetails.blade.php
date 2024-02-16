@extends('layouts.main')
@push('title')
    <title>Upohar|Shop</title>
@endpush
@section('main-section')
    <div class="w-11/12 md:w-4/5 lg:w-4/5 mx-auto my-16">
        @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif
        <div class="container mx-auto p-4">
            <div class="md:flex md:items-center md:justify-between">
                <!-- Product Image Section -->
                <div class="md:w-1/2 mb-4 md:mb-0">
                    <img src="/storage/{{ $product->image }}" alt="Product Image"
                        class="w-full md:max-w-md mx-auto rounded-lg shadow-md">
                </div>

                <!-- Product Details Section -->
                <div class="md:w-1/2 md:pl-8">
                    <!-- Product Name -->
                    <h2 class="text-3xl font-semibold mb-2">{{ $product->name }}</h2>

                    <!-- Product Price -->
                    <p class="text-xl font-semibold text-gray-800 mb-4">{{ $product->price }}</p>

                    <!-- Product Description -->
                    <p class="text-gray-700 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet eros
                        vitae arcu cursus lacinia eu vel mauris. Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Inventore culpa numquam quidem quisquam, soluta unde amet, ab quasi modi commodi quam ipsam labore,
                        consequatur illo. Ut, iure maiores? Fugiat ratione cumque reiciendis nisi aliquam iusto. Impedit
                        soluta fugiat unde vero debitis fugit. Ipsa vitae quam mollitia reprehenderit, quod unde vero! </p>

                    <!-- add to cart -->

                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <div class="flex items-center mb-4">
                            <label for="quantity" class="mr-2">Quantity:</label>
                            <input type="number" id="quantity" name="quantity" min="1" value="1"
                                class="w-16 py-1 px-3 border rounded-lg">
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Add to Cart
                        </button>
                    </form>



                </div>
            </div>
        </div>

    </div>
@endsection
