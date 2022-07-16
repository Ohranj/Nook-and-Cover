<div x-cloak x-show="showRegisterModal" class="absolute top-[50%] left-1/2 right-1/2 w-[95%] h-[375px] sm:w-[525px] -translate-y-1/2 -translate-x-1/2 bg-stone-300 rounded text-slate-700 p-4 border-2 border-indigo-500 z-10">
    <div class="relative flex flex-col h-full">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 bg-indigo-500 absolute inset-x-0 -top-14 mx-auto text-white rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <form class="flex flex-col items-center gap-2 flex-1 mt-10">
            <div class="flex flex-col w-full">
                <label class="pl-1">Email</label>
                <input class="rounded p-1" type="text" />
            </div>
            <div class="flex flex-col w-full">
                <label class="pl-1">Password</label>
                <input class="rounded p-1" type="text" />
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 bg-indigo-500 text-white rounded-full inline-block align-sub" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <small>Passwords should contain at least 8 characters and a digit.</small>
                </span>
            </div>
            <div class="flex flex-col w-full pl-1">
                <label>Confirm Password</label>
                <input name="password_confirmation" class="rounded p-1" type="text" />
            </div>
            <small x-cloak x-show="showRegisterFormError" class="mt-4" x-text="registerError">Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic, fuga.</small>
            <div class="mt-auto">
                <button type="button" class="app-btn app-btn-secondary" @click="$store.globalStates.modalShowing = false; showRegisterModal = false">Close</button>
                <button type="submit" class="app-btn app-btn-primary" @click="console.log(123)">Confirm</button>
            </div>
        </form>
    </div>
</div>