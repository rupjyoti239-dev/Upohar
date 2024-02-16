@extends('layouts.main')
@push('title')
    <title>Upohar|Login</title>
@endpush
@section('main-section')
    {{-- <div class="w-11/12 md:w-4/5 lg:w-4/5 mx-auto "> --}}
    <div class="my-28 w-11/12 md:w-2/5 px-10 py-14 rounded-md mx-auto bg-blue-200">
        <h1 class="text-center text-xl mb-5 font-bold flex justify-center items-center gap-5">Upohar<img
                src="assets/img/logo.png" alt="" class="h-8"></h1>
        <div class="max-w-sm mx-auto">
            @if (session('error'))
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            @endif
            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif
        </div>
        <form class="max-w-sm mx-auto" action="{{ route('user.login.post') }}" method="post">
            @csrf
            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                    email </label>
                <input type="email" id="email" name="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="name@flowbite.com" value="{{ old('email') }}">
                <span class="text-red-600 text-sm font-semibold">
                    @error('email')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="mb-5">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                    password</label>
                <input type="password" id="password" name="password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <span class="text-red-600 text-sm font-semibold">
                    @error('password')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="flex items-center justify-center">
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</button>
            </div>
            <p class="text-center text-md-center mt-3">Do not have an account? <a class="text-blue-600"
                    href="{{ route('user.register') }}">Register</a></p>

        </form>
    </div>
    {{-- </div> --}}
@endsection
