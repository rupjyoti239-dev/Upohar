@extends('layouts.main')
@push('title')
    <title>Upohar|Cart</title>
@endpush
@section('main-section')

    @php
        $subtotal = 0;
    @endphp
    <div class="w-11/12 md:w-4/5 lg:w-4/5 mx-auto my-16">

        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        @endif




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
                        @if (Auth::guard('customers')->check())
                            {{-- If user is logged in --}}
                            @forelse ($cart as  $item)
                                @php
                                    $itemTotal = $item['price'] * $item['quantity'];
                                    $subtotal += $itemTotal;
                                @endphp
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <img src="/storage/{{ $item['image'] }}" class="h-20" alt="{{ $item['name'] }}">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item['name'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item['price'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item['quantity'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $itemTotal }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form action="{{ route('cart.remove',['id' => $item['product_id']]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-white bg-red-600 px-3 py-1">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center">No items in the cart
                                    </td>
                                </tr>
                            @endforelse
                        @else
                            {{-- If user is not logged in --}}
                            @forelse ($cart as $id => $item)
                                @php
                                    $itemTotal = $item['price'] * $item['quantity'];
                                    $subtotal += $itemTotal;
                                @endphp
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <img src="/storage/{{ $item['image'] }}" class="h-20" alt="{{ $item['name'] }}">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item['name'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item['price'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item['quantity'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $itemTotal }}</td>
                                     <td class="px-6 py-4 whitespace-nowrap">
                                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-white bg-red-600 px-3 py-1">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center">No items in the cart
                                    </td>
                                </tr>
                            @endforelse
                        @endif
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
