@extends('layouts.main')
@push('title')
    <title>Upohar|Cart</title>
@endpush
@section('main-section')
    @php
        $subtotal = 0;
    @endphp
    <div class="w-11/12 md:w-4/5 lg:w-4/5 mx-auto my-16">
        <h1 class="text-2xl font-bold mb-4">Cart</h1>

        @if (count($cart) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Product</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Quantity</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($cart as $id => $item)
                            @php
                                $itemTotal = $item['price'] * $item['quantity'];
                                $subtotal += $itemTotal;
                            @endphp
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="/storage/{{ $item['image'] }}" class="h-20" alt="{{ $item['name'] }}"
                                        class="max-w-xs h-auto">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item['name'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item['price'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item['quantity'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item['price'] * $item['quantity'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-white bg-red-600 px-3 py-1">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="" class="px-6 py-4 whitespace-nowrap text-right">
                                <a href="{{ route('user.shop') }}"
                                    class="bg-yellow-200 px-3 py-2 rounded-md text-black">Continue Shopping</a>
                            </td>
                            <td colspan="3" class="px-6 py-4 whitespace-nowrap text-right font-bold">Subtotal:</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $subtotal }}</td>
                            {{-- <td class="px-6 py-4 whitespace-nowrap">100</td>
                            <td class="px-6 py-4 whitespace-nowrap">100</td> --}}
                            <td class="px-6 py-4 whitespace-nowrap"><a href="{{ route('user.checkout') }}"
                                    class="text-white bg-blue-600 px-4 py-2 rounded hover:bg-blue-700">Checkout</a></td>
                        </tr>


                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500">Your cart is empty.</p>
        @endif
    </div>
@endsection
