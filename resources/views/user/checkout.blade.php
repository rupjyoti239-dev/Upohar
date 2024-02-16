@extends('layouts.main')
@push('title')
    <title>Upohar|Home</title>
@endpush
@section('main-section')
    <div class="w-11/12 md:w-4/5 lg:w-4/5 mx-auto ">
        <h1 class="text-2xl font-bold mb-4 text-center">Checkout</h1>

        <form action="" method="POST" class="my-20">
            @csrf

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="name" name="name"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="mb-4">
                    <label for="contact_number" class="block text-sm font-medium text-gray-700">Contact Number</label>
                    <input type="tel" id="contact_number" name="contact_number"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="mb-4 ">
                    <label for="payment_mode" class="block text-sm font-medium text-gray-700">Payment Mode</label>
                    <select id="payment_mode" name="payment_mode"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="cash">Cash</option>
                        <option value="card">Card</option>
                    </select>
                </div>

            </div>
            <div class="mb-4 col-span-2">
                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <textarea id="address" name="address" rows="3"
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
            </div>



            <div id="card_details" class="hidden col-span-2">
                <div class="mb-4">
                    <label for="card_number" class="block text-sm font-medium text-gray-700">Card Number</label>
                    <input type="text" id="card_number" name="card_number"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="mb-4">
                    <label for="expiry_date" class="block text-sm font-medium text-gray-700">Expiry Date</label>
                    <input type="text" id="expiry_date" name="expiry_date"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="mb-4">
                    <label for="cvv" class="block text-sm font-medium text-gray-700">CVV</label>
                    <input type="text" id="cvv" name="cvv"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>


            <div class="flex justify-center">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition">Place
                    Order</button>
            </div>
        </form>

        <script>
            document.getElementById('payment_mode').addEventListener('change', function() {
                var cardDetails = document.getElementById('card_details');
                if (this.value === 'card') {
                    cardDetails.classList.remove('hidden');
                } else {
                    cardDetails.classList.add('hidden');
                }
            });
        </script>

    </div>
@endsection
