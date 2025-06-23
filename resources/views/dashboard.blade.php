<x-app-layout>

    <li class="px-4 py-2 hover:bg-blue-100">
    <a href="{{ route('chat') }}" class="flex items-center space-x-2 text-gray-700">
        <svg class="w-5 h-5" ...> <!-- Optional icon --> </svg>
        <span>Chat</span>
    </a>
</li>


<form method="POST" action="{{ route('logout') }}">
    @csrf
    <a href="#" onclick="this.closest('form').submit()" class="text-red-600 hover:underline">Logout</a>
</form>



    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
