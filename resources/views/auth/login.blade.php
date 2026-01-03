<x-guest-layout>
    <div class="bg-white dark:bg-gray-900">
        <div class='flex justify-center h-screen'>
            <!-- Background Image Section -->
            <div class="hidden bg-cover lg:block lg:w-2/3" style="background-image: url('https://images.stockcake.com/public/b/c/0/bc0dc4ca-0cb7-4c94-8ff3-0b82768288b4/hardware-store-aisle-stockcake.jpg')">
                <div class="flex items-center h-full px-20 bg-gray-900/40">
                    <div>
                        <h2 class="text-4xl font-bold text-white">Welcome to SicoInfa</h2>
                        <p class="max-w-xl mt-3 text-gray-300">Manage your inventory with ease and efficiency.</p>
                    </div>
                </div>
            </div>

            <!-- Login Form Section -->
            <div class="flex items-center w-full max-w-md px-6 mx-auto lg:w-2/6">
                <div class="flex-1">
                    <div class="text-center">
                        <h2 class="text-4xl font-bold text-center text-gray-700 dark:text-white">SICOINFA</h2>
                        <p class="mt-3 text-gray-500 dark:text-gray-300">Inicio de Sesión de Administrador</p>
                    </div>

                    <div class="mt-8">
                        <x-form action="{{ route('login') }}">
                            <div class="space-y-6">
                                <div>
                                    <x-input 
                                        type="email" 
                                        name="email" 
                                        label="Correo Electrónico" 
                                        placeholder="ejemplo@correo.com" 
                                        :value="old('email')"
                                        required 
                                        autofocus 
                                        :error="$errors->first('email')"
                                    >
                                        <x-slot name="prepend">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                            </svg>
                                        </x-slot>
                                    </x-input>
                                </div>
    
                                <div>
                                    <x-input 
                                        type="password" 
                                        name="password" 
                                        label="Contraseña" 
                                        placeholder="Ingrese su contraseña"
                                        required 
                                        :error="$errors->first('password')"
                                    >
                                        <x-slot name="prepend">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            </svg>
                                        </x-slot>
                                    </x-input>
                                </div>
    
                                <div class="flex items-center justify-between">
                                    <label for="remember_me" class="inline-flex items-center">
                                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                                    </label>
    
                                    @if (Route::has('password.request'))
                                        <a class="text-sm text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300" href="{{ route('password.request') }}">
                                            {{ __('Forgot password?') }}
                                        </a>
                                    @endif
                                </div>
    
                                <div>
                                    <x-button type="submit" variant="primary" class="w-full justify-center py-3">
                                        Iniciar Sesión
                                    </x-button>
                                </div>
                            </div>
                        </x-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
