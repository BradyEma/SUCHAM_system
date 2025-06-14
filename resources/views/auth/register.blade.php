<x-guest-layout>
    <div class="flex flex-col items-center justify-center h-[92vh] bg-gray-100">
        <img src="{{ asset('sucham.jpg') }}" alt="SUCHAM Logo" class="w-24 mb-4">
        <h1 class="text-2xl font-bold mb-6 text-sky-800">Create a SUCHAM Account</h1>

        <form method="POST" action="{{ route('register') }}" class="w-full max-w-sm bg-white p-6 rounded shadow">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input id="name" class="mt-1 w-full border-gray-300 rounded shadow-sm" type="text" name="name" required autofocus />
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" class="mt-1 w-full border-gray-300 rounded shadow-sm" type="email" name="email" required />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" class="mt-1 w-full border-gray-300 rounded shadow-sm" type="password" name="password" required />
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input id="password_confirmation" class="mt-1 w-full border-gray-300 rounded shadow-sm" type="password" name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-between">
                <button class="bg-sky-600 hover:bg-sky-700 text-white px-4 py-2 rounded" type="submit">
                    Register
                </button>
                <a href="{{ route('login') }}" class="text-sm text-sky-600 hover:underline">Already have an account?</a>
            </div>
        </form>
    </div>
</x-guest-layout>
