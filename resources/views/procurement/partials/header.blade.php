<header class="dashboard-header">
    <div class="header-left">
        <img src="{{ asset('images/logo.png') }}" alt="GoldenFields Logo" class="logo">
        <h1>Procurement Dashboard</h1>
    </div>
    <div class="header-right">
        <span class="datetime">{{ now()->format('F j, Y, g:i a') }}</span>
        <div class="user-profile">
            <i class="fas fa-user-circle"></i>
            <span>{{ Auth::user()->name ?? 'Guest' }}</span>
        </div>
    </div>
</header>