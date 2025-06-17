<x-guest-layout>
    <!-- Removed the outer flex/centering div -->
    


        <div class="w-full max-w-7xl mx-auto bg-white rounded-xl shadow-2xl overflow-hidden">

            <!-- Header -->
            <div class="bg-sky-600 py-6 px-8">
                <h1 class="text-4xl font-bold text-white text-center">SUCHAM</h1>
                <h2 class="text-2xl font-semibold text-white text-center mt-2">Register as Supplier</h2>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('register.supplier') }}" enctype="multipart/form-data" class="p-8">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <!-- Left Column -->
                    <div class="space-y-5 me-6">
                        <div>
                            <x-input-label for="name" :value="__('Full Name')" class="text-black" />
                            <input id="name" class="block mt-3 w-full px-4 py-2 border border-black bg-white text-black rounded-md" type="text" name="name" required autofocus />
                        </div>

                        <div>
                            <x-input-label for="business_name" :value="__('Business Name')" class="text-black" />
                            <input id="business_name" class="block mt-3 w-full px-4 py-2 border border-black bg-white text-black rounded-md" type="text" name="business_name" required />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email')" class="text-black" />
                            <input id="email" class="block mt-3 w-full px-4 py-2 border border-black bg-white text-black rounded-md" type="email" name="email" required />
                        </div>

                        <div>
                            <x-input-label for="raw_material" :value="__('Raw Material')" class="text-black" />
                            <select name="raw_material" id="raw_material" class="block mt-3 w-full px-4 py-2 border border-black bg-white text-black rounded-md">
                                
                                <option value="sugarcane">Sugarcane</option>
                                <option value="packaging">Packaging bags</option>
                                <option value="preservatives">Preservatives</option>
                            </select>
                        </div>

                        <div>
                            <x-input-label for="tin_or_nin" :value="__('TIN or NIN')" class="text-black" />
                            <input id="tin_or_nin" class="block mt-3 w-full px-4 py-2 border border-black bg-white text-black rounded-md" type="text" name="tin_or_nin" required />
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-5 ms-4">
                        <div>
                            <x-input-label for="location" :value="__('Location')" class="text-black" />
                            <input id="location" class="block mt-3 w-full px-4 py-2 border border-black bg-white text-black rounded-md" type="text" name="location" required />
                        </div>

                        <div>
                            <x-input-label for="verification_file" :value="__('Verification Document')" class="text-black" />
                            <div class="mt-3 flex items-center">
                                <label class="w-full">
                                    <div class="flex flex-col items-center px-4 py-4 bg-white rounded-md border-2 border-dashed border-sky-600 cursor-pointer hover:bg-gray-100 transition">
                                        <svg class="w-6 h-6 text-black mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                        <span class="text-sm font-medium text-black">Click to upload</span>
                                        <span class="text-xs text-gray-600 mt-3">PDF, DOC, JPG up to 5MB</span>
                                        <input id="verification_file" type="file" name="verification_file" class="hidden" required />
                                    </div>
                                </label>
                            </div>
                            <div id="file-chosen" class="text-sm text-sky-600 mt-2 text-center">No file chosen</div>
                        </div>

                        <div>
                            <x-input-label for="password" :value="__('Password')" class="text-black" />
                            <input id="password" class="block mt-3 w-full px-4 py-2 border border-black bg-white text-black rounded-md" type="password" name="password" required />
                        </div>

                        <div>
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-black" />
                            <input id="password_confirmation" class="block mt-3 w-full px-4 py-2 border border-black bg-white text-black rounded-md" type="password" name="password_confirmation" required />
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="w-full bg-sky-600 hover:scale-105 transition-transform text-white font-bold py-3 px-4 rounded-md transition duration-200 text-lg">
                                Register as Supplier
                            </button>
                        </div>
                        @if(session('message'))
                         <div class="alert alert-success">
                          {{ session('message') }}
                          </div>
                       @endif

                    </div>
                </div>
            </form>
        </div>
    

    <script>
        const fileInput = document.getElementById('verification_file');
        const fileChosen = document.getElementById('file-chosen');
        fileInput.addEventListener('change', function () {
            fileChosen.textContent = this.files.length > 0 ? this.files[0].name : 'No file chosen';
        });
    </script>
</x-guest-layout>
