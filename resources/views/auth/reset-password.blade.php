<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-xl font-extrabold text-[#031026]">Buat Password Baru</h2>
        <p class="text-xs text-slate-500 mt-1">Silakan masukkan kata sandi baru untuk akun Anda</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <label for="email" class="block text-xs font-bold uppercase text-slate-600 mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus
                   class="w-full px-3.5 py-2.5 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454] focus:ring-2 focus:ring-yellow-400/50">
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div>
            <label for="password" class="block text-xs font-bold uppercase text-slate-600 mb-1">Password Baru</label>
            <input id="password" type="password" name="password" required
                   class="w-full px-3.5 py-2.5 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454] focus:ring-2 focus:ring-yellow-400/50">
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div>
            <label for="password_confirmation" class="block text-xs font-bold uppercase text-slate-600 mb-1">Konfirmasi Password Baru</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                   class="w-full px-3.5 py-2.5 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454] focus:ring-2 focus:ring-yellow-400/50">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <button type="submit" class="w-full py-2.5 px-4 bg-[#031026] hover:bg-[#0a2963] text-yellow-400 font-bold text-sm rounded-lg shadow-md transition">
            SIMPAN PASSWORD BARU
        </button>
    </form>
</x-guest-layout>
