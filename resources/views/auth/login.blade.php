<x-guest-layout>
    <div class="mb-5 text-center">
        <h2 class="text-xl font-extrabold text-[#031026]">Masuk ke Akun Anda</h2>
        <p class="text-xs text-slate-500 mt-1">Silakan masukkan email dan kata sandi terdaftar</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block text-xs font-bold uppercase text-slate-600 mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                   class="w-full px-3.5 py-2.5 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454] focus:ring-2 focus:ring-yellow-400/50">
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-bold uppercase text-slate-600 mb-1">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="w-full px-3.5 py-2.5 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454] focus:ring-2 focus:ring-yellow-400/50">
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between text-xs">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" name="remember" class="rounded border-slate-300 text-[#082454] focus:ring-yellow-400">
                <span class="ms-2 text-slate-600">Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="font-semibold text-[#082454] hover:text-amber-600">
                    Lupa password?
                </a>
            @endif
        </div>

        <!-- Tombol Login -->
        <div class="pt-2">
            <button type="submit" class="w-full py-2.5 px-4 bg-[#031026] hover:bg-[#0a2963] text-yellow-400 font-bold text-sm rounded-lg shadow-md transition flex justify-center items-center">
                MASUK SEKARANG
            </button>
        </div>

        <!-- Tautan Register -->
        @if (Route::has('register'))
            <div class="text-center pt-3 border-t border-slate-100 text-xs text-slate-600">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="font-bold text-[#082454] hover:text-amber-600 underline">Daftar di sini</a>
            </div>
        @endif
    </form>
</x-guest-layout>
