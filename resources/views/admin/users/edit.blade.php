<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <x-alert />

                    <form action="{{ route('admin.users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Nama -->
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-700">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('name') border-red-500 @enderror">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-700">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('email') border-red-500 @enderror">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-700">
                                    Password Baru
                                </label>
                                <input type="password" name="password" id="password"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('password') border-red-500 @enderror">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Kosongkan jika tidak ingin mengubah password</p>
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-700">
                                    Konfirmasi Password
                                </label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <!-- Role -->
                            <div>
                                <label for="role" class="block mb-2 text-sm font-medium text-gray-700">
                                    Role <span class="text-red-500">*</span>
                                </label>
                                <select name="role" id="role" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('role') border-red-500 @enderror"
                                    onchange="toggleBankSampah()">
                                    <option value="">Pilih Role</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}" {{ old('role', $user->roles->first()?->name) == $role->name ? 'selected' : '' }}>
                                            {{ ucfirst($role->name) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Bank Sampah -->
                            <div id="bank-sampah-field" style="display: none;">
                                <label for="bank_sampah_id" class="block mb-2 text-sm font-medium text-gray-700">
                                    Bank Sampah <span class="text-red-500">*</span>
                                </label>
                                <select name="bank_sampah_id" id="bank_sampah_id"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Pilih Bank Sampah</option>
                                    @foreach($bankSampah as $bank)
                                        <option value="{{ $bank->id }}" {{ old('bank_sampah_id', $user->bank_sampah_id) == $bank->id ? 'selected' : '' }}>
                                            {{ $bank->nama_bank }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('bank_sampah_id')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex justify-end mt-6 space-x-3">
                            <a href="{{ route('admin.users.index') }}" class="px-4 py-2 font-bold text-gray-800 bg-gray-300 rounded hover:bg-gray-400">
                                Batal
                            </a>
                            <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function toggleBankSampah() {
            const roleSelect = document.getElementById('role');
            const bankSampahField = document.getElementById('bank-sampah-field');
            const bankSampahSelect = document.getElementById('bank_sampah_id');
            
            if (roleSelect.value === 'bank_sampah') {
                bankSampahField.style.display = 'block';
                bankSampahSelect.required = true;
            } else {
                bankSampahField.style.display = 'none';
                bankSampahSelect.required = false;
                bankSampahSelect.value = '';
            }
        }
        
        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            toggleBankSampah();
        });
    </script>
    @endpush
</x-app-layout>