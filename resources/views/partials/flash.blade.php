@if(session('success'))
  <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 transition-all duration-200">
    {{ session('success') }}
  </div>
@endif

@if(session('error'))
  <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 transition-all duration-200">
    {{ session('error') }}
  </div>
@endif
