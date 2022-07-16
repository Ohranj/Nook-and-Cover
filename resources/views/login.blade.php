<x-layouts.guest>
    <div x-data="register" class="h-screen flex flex-col">
        <nav class="border-b h-[75px] px-4">
            <ul class="flex justify-end items-center h-full gap-4">
                <li>
                    <button class="app-btn app-btn-primary" :disabled="showRegisterModal" @click="$store.globalStates.modalShowing = true; showRegisterModal = true">Register</button>
                </li>
                <li>
                    <button class="app-btn app-btn-primary" :disabled="showRegisterModal">Contact Us</button>
                </li>
            </ul>
        </nav>
        <div x-data="{password: null, showPassword: false}" class="flex flex-1 justify-center items-center mx-2 flex-col mb-24 sm:mb-44" :class="$store.globalStates.modalShowing ? 'blur-sm' : ''">
            @if (session('throttled'))
                <div class="border-2 w-full sm:w-3/4 mx-auto mb-8 bg-indigo-500 rounded p-1 text-white text-sm md:text-base">
                    <p class="text-center mb-1">You have had too many incorrect attempts. Please try again in {{ session('throttled') }} seconds.</p>
                    <p class="text-center">Alternatively, you can <a class="app-link">click here</a> to reset your password, or <a @click="$store.globalStates.modalShowing = true; showRegisterModal = true" class="app-link">click here</a> to register an account.</p>
                </div>
            @endif
            <h1 class="font-Lobster text-5xl sm:text-6xl mb-2 text-slate-700">Nook and Cover</h1>
            <div class="border-2 border-slate-500 rounded w-full h-[300px] sm:w-[500px] p-2 flex justify-center items-end relative shadow-xl shadow-slate-400">
                <form method="POST" action="{{ route('login_post_url') }}" class="w-full px-2 mt-auto mb-12 z-10">
                    @csrf
                    <div class="form-group mb-3 flex flex-col">
                        <label for="email" class="pl-1">Email</label>
                        <input type="text" placeholder="Email..." class="form-control rounded p-1" name="email" required autofocus>
                    </div>
                    <div class="form-group mb-3 flex flex-col relative">
                        <label for="password" class="pl-1">Password</label>
                        <input x-model="password" :type="!showPassword ? 'password' : 'text'" placeholder="Password..." class="form-control rounded p-1" name="password" required>
                        <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute right-[6px] bottom-[6px] cursor-pointer" viewBox="0 0 20 20" fill="currentColor" @click="showPassword = !showPassword">
                            <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                            <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                        </svg>
                        <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute right-[6px] bottom-[6px] cursor-pointer" viewBox="0 0 20 20" fill="currentColor" @click="showPassword = !showPassword">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="form-group mb-1">
                        <div class="checkbox">
                            <label class="ml-1">
                                <input type="checkbox" name="remember" class="h-[20px] w-[20px] align-sub cursor-pointer"> Remember Me
                            </label>
                        </div>
                    </div>
                    <button class="float-right app-btn app-btn-primary">Sign in</button> 
                </form>
                <p class="absolute bottom-2 text-red-500">
                    @if ($errors->any())
                    {{$errors->first('credentials')}}
                    @endif
                </p>
            </div>
        </div>
        <x-register/>
    </div>
    <script>
        const register = () => ({
            showRegisterModal: false,
            showRegisterFormError: false,
            registerFormErrors: ['Your passwords do not match.', 'A user with that email already exists.'],
            registerError: '',
        })
    </script>
</x-layouts.guest>