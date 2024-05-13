<nav class="fixed top-0 z-50 bg-transparent w-screen transition-colors" x-data="{ scrolled: false }" @scroll.window="scrolled = window.scrollY > 40" :class="scrolled && 'bg-gray-600'">
    <div class="mx-auto container flex justify-between items-center py-6">
        <div>
            <a href="{{ route('home') }}">
                <img src="{{ asset('assets/logolight.png') }}" alt="logo" class="max-h-6">
            </a>
        </div>
        <div class="text-white uppercase">
            <ul class="flex gap-8">
                <li>
                    <a href=" {{ route('home') }} " class="hover:text-info-200 transition-colors">Home</a>
                </li>
                <li>
                    <a href=" {{ route('receipt') }}" class="hover:text-info-200 transition-colors">Cek Resi</a>
                </li>
                <li>
                    <a href=" {{ route('show-costs') }} " class="hover:text-info-200 transition-colors">Biaya Pengiriman</a>
                </li>
                <li>
                    <a href="{{ route('contact-us') }}" class="hover:text-info-200 transition-colors">Hubungi Kami</a>
                </li>

                @auth()
                <li>
                    <a href=" {{ route('filament.admin.auth.login') }} " target="_blank" class="hover:text-info-200 transition-colors">Dashboard</a>
                </li>
                @else()
                <li>
                    <a href=" {{ route('filament.admin.auth.login') }} " target="_blank" class="hover:text-info-200 transition-colors">Login</a>
                </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>