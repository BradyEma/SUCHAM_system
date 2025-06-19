<x-guest-layout>
    <div class="flex flex-col items-center justify-center h-[80vh] bg-gray-100">
        <img src="{{ asset('sucham.jpg') }}" alt="SUCHAM Logo" class="w-24 mb-4">
        <h1 class="text-2xl font-bold mb-6 text-sky-800">Login to SUCHAM</h1>
          @if (session('status'))
            <div class="mb-4 text-green-600 font-bold">
             {{ session('status') }}
            </div>
            @endif
           

        <!-- Default Breeze login form -->
        <form method="POST" action="{{ route('login') }}" class="w-full max-w-sm bg-white p-6 rounded shadow">
            @csrf
            
            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" class="mt-1 w-full border-gray-300 rounded shadow-sm" type="email" name="email" required autofocus />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" class="mt-1 w-full border-gray-300 rounded shadow-sm" type="password" name="password" required />
            </div>

            <!-- Remember Me -->
            <div class="mb-4 flex items-center">
                <input type="checkbox" name="remember" id="remember" class="mr-2">
                <label for="remember" class="text-sm text-gray-600">Remember me</label>
            </div>

            <div class="flex items-center justify-between">
                <button class="bg-sky-600 hover:bg-sky-700 text-white px-4 py-2 rounded" type="submit">
                    Login
                </button>
                <a href="{{ route('register') }}" class="text-sm text-sky-600 hover:underline">Create account</a>
            </div>
        </form>
    </div>
</x-guest-layout>
