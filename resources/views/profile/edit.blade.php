<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-extrabold text-[#031026] flex items-center">
            <span class="w-2 h-6 bg-yellow-400 mr-3 rounded-sm"></span>
            Pengaturan Profil & Keamanan Akun
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- KARTU 1: UPDATE INFORMASI PROFIL -->
        <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-[#082454]">
            <h3 class="text-base font-bold text-[#031026] mb-1">Informasi Profil</h3>
            <p class="text-xs text-slate-500 mb-5">Perbarui nama lengkap dan alamat email akun Anda.</p>

            <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
                @csrf
                @method('patch')

                <div>
                    <label for="name" class="block text-xs font-bold uppercase text-slate-600 mb-1">Nama Lengkap</label>
                    <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus
                           class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454] focus:ring-2 focus:ring-yellow-400/50">
                    <x-input-error class="mt-1" :messages="$errors->get('name')" />
                </div>

                <div>
                    <label for="email" class="block text-xs font-bold uppercase text-slate-600 mb-1">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                           class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454] focus:ring-2 focus:ring-yellow-400/50">
                    <x-input-error class="mt-1" :messages="$errors->get('email')" />
                </div>

                <div class="flex items-center gap-4 pt-2">
                    <button type="submit" class="px-5 py-2 bg-[#031026] hover:bg-[#0a2963] text-yellow-400 text-xs font-bold uppercase tracking-wider rounded-lg shadow transition">
                        Simpan Profil
                    </button>

                    @if (session('status') === 'profile-updated')
                        <span class="text-xs font-semibold text-green-600">✓ Profil berhasil diperbarui.</span>
                    @endif
                </div>
            </form>
        </div>

        <!-- KARTU 2: GANTI PASSWORD (CHANGE PASSWORD) -->
        <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-yellow-400">
            <h3 class="text-base font-bold text-[#031026] mb-1">Ubah Kata Sandi (Change Password)</h3>
            <p class="text-xs text-slate-500 mb-5">Pastikan akun Anda menggunakan kata sandi yang panjang dan aman.</p>

            <form method="post" action="{{ route('password.update') }}" class="space-y-4">
                @csrf
                @method('put')

                <div>
                    <label for="update_password_current_password" class="block text-xs font-bold uppercase text-slate-600 mb-1">Password Saat Ini</label>
                    <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password"
                           class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454] focus:ring-2 focus:ring-yellow-400/50">
                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1" />
                </div>

                <div>
                    <label for="update_password_password" class="block text-xs font-bold uppercase text-slate-600 mb-1">Password Baru</label>
                    <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                           class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454] focus:ring-2 focus:ring-yellow-400/50">
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1" />
                </div>

                <div>
                    <label for="update_password_password_confirmation" class="block text-xs font-bold uppercase text-slate-600 mb-1">Konfirmasi Password Baru</label>
                    <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                           class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454] focus:ring-2 focus:ring-yellow-400/50">
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-1" />
                </div>

                <div class="flex items-center gap-4 pt-2">
                    <button type="submit" class="px-5 py-2 bg-yellow-400 hover:bg-amber-500 text-[#031026] text-xs font-bold uppercase tracking-wider rounded-lg shadow transition">
                        Update Password
                    </button>

                    @if (session('status') === 'password-updated')
                        <span class="text-xs font-semibold text-green-600">✓ Password berhasil diganti.</span>
                    @endif
                </div>
            </form>
        </div>

    </div>
</x-app-layout>
