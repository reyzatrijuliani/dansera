<aside class="sidebar">
    <a href="{{ route('admin.dashboard') }}" class="logo">Dansera.</a>

    <p class="menu-title">MENU UTAMA</p>

    <nav class="menu" aria-label="Navigasi admin">
        <a href="{{ route('admin.dashboard') }}" @class(['active' => request()->routeIs('admin.dashboard')]) @if(request()->routeIs('admin.dashboard')) aria-current="page" @endif>
            <span aria-hidden="true">⌂</span>
            Dashboard Admin
        </a>

        <a href="{{ route('bookings.index') }}" @class(['active' => request()->routeIs('bookings.*')]) @if(request()->routeIs('bookings.*')) aria-current="page" @endif>
            <span aria-hidden="true">▦</span>
            Kelola Booking
        </a>

        <a href="{{ route('admin.studios.index') }}" @class(['active' => request()->routeIs('admin.studios.*')]) @if(request()->routeIs('admin.studios.*')) aria-current="page" @endif>
            <span aria-hidden="true">♡</span>
            Kelola Studio
        </a>
    </nav>

    <div class="menu logout">
        <a href="{{ url('/') }}">
            <span aria-hidden="true">↩</span>
            Kembali ke Website
        </a>
    </div>
</aside>
