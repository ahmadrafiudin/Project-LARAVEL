<x-guest-layout>
    <div class="mb-5 text-center">
        <h2 class="text-xl font-extrabold text-[#031026]">Registrasi Pengguna Baru</h2>
        <p class="text-xs text-slate-500 mt-1">Lengkapi data diri untuk membuat akun baru</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Nama Lengkap -->
        <div>
            <label for="name" class="block text-xs font-bold uppercase text-slate-600 mb-1">Nama Lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                   class="w-full px-3.5 py-2.5 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454] focus:ring-2 focus:ring-yellow-400/50">
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-xs font-bold uppercase text-slate-600 mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                   class="w-full px-3.5 py-2.5 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454] focus:ring-2 focus:ring-yellow-400/50">
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-bold uppercase text-slate-600 mb-1">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                   class="w-full px-3.5 py-2.5 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454] focus:ring-2 focus:ring-yellow-400/50">
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Konfirmasi Password -->
        <div>
            <label for="password_confirmation" class="block text-xs font-bold uppercase text-slate-600 mb-1">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                   class="w-full px-3.5 py-2.5 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454] focus:ring-2 focus:ring-yellow-400/50">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <!-- Tombol Register -->
        <div class="pt-2">
            <button type="submit" class="w-full py-2.5 px-4 bg-[#031026] hover:bg-[#0a2963] text-yellow-400 font-bold text-sm rounded-lg shadow-md transition">
                DAFTAR AKUN
            </button>
        </div>

        <div class="text-center pt-3 border-t border-slate-100 text-xs text-slate-600">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="font-bold text-[#082454] hover:text-amber-600 underline">Masuk di sini</a>
        </div>
    </form>
</x-guest-layout>
