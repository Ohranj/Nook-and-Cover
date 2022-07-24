<div x-cloak x-show="showRegisterModal" @keyup.escape.window="$refs.closeRegisterModalBtn.click()" class="absolute top-[50%] left-1/2 right-1/2 w-[95%] sm:w-[525px] -translate-y-1/2 -translate-x-1/2 bg-stone-300 rounded text-slate-700 p-4 border-2 border-indigo-500 z-10" :class="registerIsSuccess ? 'h-[350px]' : 'h-[375px]'">
    <div class="relative flex flex-col h-full">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 bg-indigo-500 absolute inset-x-0 -top-14 mx-auto text-white rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <div x-cloak x-show="registerIsSuccess" class="mt-10 text-center flex flex-col items-center gap-4">
            <h2 class="text-3xl font-bold">Success</h2>
            <p>We've sent you a verification email!</p>
            <p>Please view your email account, click the link we have provided and then you're all setup.</p>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mt-4 animate-bounce text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <button class="app-btn app-btn-primary" @click.prevent="$refs.closeRegisterModalBtn.click()">Close</button>
        </div>
        <form x-show="!registerIsSuccess" class="flex flex-col items-center gap-2 flex-1 mt-10" id="f_register">
            <div class="flex flex-col w-full">
                <label class="pl-1">Email</label>
                <input x-model="reg_email" class="rounded p-1" placeholder="Email..." name="reg_email" />
            </div>
            <div class="flex flex-col w-full relative">
                <label class="pl-1">Password</label>
                <input x-model="reg_password" class="rounded p-1" :type="showPasswordAsPlainText ? 'text' : 'password'" placeholder="Password..." name="reg_password" />
                <svg x-show="!showPasswordAsPlainText" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute right-[6px] bottom-[30px] cursor-pointer" viewBox="0 0 20 20" fill="currentColor" @click="showPasswordAsPlainText = !showPasswordAsPlainText">
                    <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                    <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                </svg>
                <svg x-show="showPasswordAsPlainText" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute right-[6px] bottom-[30px] cursor-pointer" viewBox="0 0 20 20" fill="currentColor" @click="showPasswordAsPlainText = !showPasswordAsPlainText">
                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                </svg>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 bg-indigo-500 text-white rounded-full inline-block align-sub" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <small>Passwords should contain at least 8 characters and a digit.</small>
                </span>
            </div>
            <div class="flex flex-col w-full pl-1">
                <label>Confirm Password</label>
                <input x-model="reg_confirm_password" name="reg_password_confirmation" class="rounded p-1" :type="showPasswordAsPlainText ? 'text' : 'password'" placeholder="Confirm your password..." />
            </div>
            <small class="text-red-500 text-sm md:text-base text-center">
                <span x-cloak x-show="passwordFailed">Please make sure that your passwords match, it contains a digit and is at least 8 characters long.</span>
                <span x-cloak x-show="emailFailed">Please make sure you are using a valid email. If you have registered with us before <a class="app-link">click here</a> to reset your password</span>
                <span x-cloak x-show="isThrottled">You are doing that too much. Please try again in <span x-text="throttleTimeRemaining"></span> seconds.</span>
                <span x-cloak x-show="showGenericError">We are having trouble fulfilling your request at the minute. Please try back shortly</span>
            </small>
            <div class="mt-auto">
                <button type="button" class="app-btn app-btn-secondary" @click="$store.globalStates.modalShowing = false; showRegisterModal = false; resetFormState()" x-ref="closeRegisterModalBtn">Close</button>
                <button class="app-btn app-btn-primary" :disabled="!validRegisterForm" @click.prevent="confirmBtnPressed">Confirm</button>
            </div>
        </form>
    </div>
</div>