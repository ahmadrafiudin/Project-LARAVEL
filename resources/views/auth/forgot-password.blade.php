<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-xl font-extrabold text-[#031026]">Lupa Password?</h2>
        <p class="text-xs text-slate-500 mt-1">Masukkan email Anda dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf
        <div>
            <label for="email" class="block text-xs font-bold uppercase text-slate-600 mb-1">Email Terdaftar</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="w-full px-3.5 py-2.5 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454] focus:ring-2 focus:ring-yellow-400/50">
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <button type="submit" class="w-full py-2.5 px-4 bg-[#031026] hover:bg-[#0a2963] text-yellow-400 font-bold text-sm rounded-lg shadow-md transition">
            KIRIM LINK RESET PASSWORD
        </button>

        <div class="text-center pt-2 text-xs">
            <a href="{{ route('login') }}" class="font-semibold text-[#082454] hover:text-amber-600">← Kembali ke Halaman Login</a>
        </div>
    </form>
</x-guest-layout>
