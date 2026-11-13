<header class="sticky top-0 z-10 flex items-center justify-between h-14 px-5 bg-[#031026] text-white border-b-2 border-yellow-400 shadow-md">
    
    <!-- Kiri: Tombol Toggle Sidebar & Info Status -->
    <div class="flex items-center space-x-4">
        <button onclick="toggleSidebar()" type="button" class="p-2 text-yellow-400 hover:bg-[#0b2a5e] rounded-md transition focus:outline-none">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <!-- Lencana Info Ala Topbar Referensi -->
        <div class="hidden md:flex items-center space-x-3 text-xs">
            <span class="inline-flex items-center px-2.5 py-1 rounded bg-yellow-400 text-[#031026] font-bold">
                <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                {{ now()->format('d M Y') }}
            </span>
            <span class="text-blue-200 tracking-wide">Sistem Informasi Manajemen Aset</span>
        </div>
    </div>

    <!-- Kanan: Menu Dropdown Profil User -->
    <div class="flex items-center space-x-3">
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-[#0a2552] hover:bg-[#113675] border border-blue-700/50 rounded-md transition focus:outline-none">
                    <span class="w-2 h-2 mr-2 rounded-full bg-yellow-400"></span>
                    <div>{{ Auth::user()->name }}</div>
                    <div class="ms-1.5 text-yellow-400">
                        <svg class="w-4 h-4 fill-current" xmlns="http://w3.org" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-dropdown-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</header>
