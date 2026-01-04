<x-guest-layout>

    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">

        <div class="flex items-center justify-center min-h-screen">
            <div class="w-full max-w-md bg-white rounded-lg shadow-lg dark:bg-gray-800">
                <div
                    class="px-6 py-4 text-lg font-semibold text-gray-900 border-b border-gray-200 dark:border-gray-700 dark:text-white">
                    {{ __('Código de verificación') }}
                </div>

                <div class="p-6">
                    <p class="mb-4 text-gray-700 dark:text-gray-300">
                        {{ __('Ingrese el código de desbloqueo del sistema.') }}</p>

                    <form id="otpForm" class="inline" method="POST" action="" onsubmit="showSubmitLoading()">
                        @csrf
                        <div class="mt-6">
                            <div class="flex justify-between mb-2">
                                <label class="text-sm text-gray-600 dark:text-gray-400">
                                    Código de Desbloqueo
                                </label>
                            </div>

                            <!-- 6 OTP Password Inputs -->
                            <div class="flex justify-between space-x-2">
                                @for ($i = 0; $i < 6; $i++)
                                    <input type="password" name="otp_{{ $i }}" id="otp_{{ $i }}"
                                        maxlength="1"
                                        class="w-12 h-12 text-center text-xl font-semibold border @error('otp') border-red-500 dark:border-red-600 @else border-gray-200 dark:border-gray-600 @enderror rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:border-blue-400 dark:focus:border-blue-500 focus:ring-blue-400 dark:focus:ring-blue-500 focus:outline-none focus:ring focus:ring-opacity-40"
                                        @if ($i === 0) autofocus @endif
                                        oninput="handleInput(this, {{ $i }})"
                                        onkeydown="handleKeyDown(event, {{ $i }})"
                                        onpaste="handlePaste(event)" />
                                @endfor
                            </div>

                            <!-- Hidden input for the complete OTP -->
                            <input type="hidden" name="otp" id="completeOtp">

                            @error('otp')
                                <span class="block mt-2 text-xs text-red-500" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mt-6">
                            <x-button type="submit" id="submitBtn" variant="info" class="w-full">
                                <span id="submitText">Desbloquear Sistema</span>
                                <svg id="submitLoader" class="hidden w-4 h-4 ml-2 text-white animate-spin"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                            </x-button>
                        </div>

                        <div class="mt-4 text-center">
                            <div id="resendContainer" class="hidden">
                                <button type="button" onclick="openResendModal()"
                                    class="text-sm text-blue-500 underline dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300">
                                    Solicitar reenvío de código
                                </button>
                            </div>
                            <div id="timerContainer" class="text-sm text-gray-500 dark:text-gray-400">
                                Puede solicitar reenvio de código en: <span id="countdown">10</span> segundos
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal para solicitar nuevo código -->
        <x-modal name="resend-otp" :show="false" maxWidth="md">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Solicitar Reenvío de Código</h3>
                    <button type="button" onclick="closeResendModal()"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>

                <form id="resendForm" onsubmit="handleResendSubmit(event)" data-resend-route="">
                    @csrf
                    <div class="mb-4">
                        <label for="modal_email"
                            class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" name="email" id="modal_email" value=""
                            class="w-full px-3 py-2 text-gray-900 bg-white border border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="mb-4">
                        <label for="password"
                            class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Confirmar
                            Contraseña</label>
                        <input type="password" name="password" id="password" required
                            class="w-full px-3 py-2 text-gray-900 bg-white border border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="mb-6">
                        <label for="cc_email"
                            class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Email CC
                            (opcional)</label>
                        <input type="email" name="cc_email" id="cc_email" placeholder="admin@ejemplo.com"
                            class="w-full px-3 py-2 text-gray-900 placeholder-gray-400 bg-white border border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="flex justify-end space-x-3">
                        <x-button type="button" variant="secondary" onclick="closeResendModal()">
                            Cancelar
                        </x-button>
                        <x-button type="submit" id="resendBtn" variant="info">
                            <span id="resendText">Solicitar</span>
                            <svg id="resendLoader" class="hidden w-4 h-4 ml-2 text-white animate-spin"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </x-button>
                    </div>
                </form>
            </div>
        </x-modal>
    </div>
    @vite('public/js/page/auth/otp.js')
</x-guest-layout>
