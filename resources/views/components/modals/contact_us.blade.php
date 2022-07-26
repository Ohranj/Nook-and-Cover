<div x-cloak x-show="showContactUsModal" @keyup.escape.window="$refs.closeContactUsModal.click()" class="absolute top-[50%] left-1/2 right-1/2 w-[95%] sm:w-[525px] h-[375px] -translate-y-1/2 -translate-x-1/2 bg-stone-300 rounded text-slate-700 p-4 border-2 border-indigo-500 z-10 flex flex-col">
    <div class="flex-1">
        <h2 class="text-xl text-center">Send us a message and we will make it a priority to get back to you.</h2>
        <form method="post" class="mt-5">
            <div class="flex justify-center gap-2">
                <div class="form-group mb-3 flex flex-col flex-1">
                    <label for="contact_firstname" class="pl-1">Firstname</label>
                    <input class="form-control rounded p-1" name="contact_firstname" required autofocus />
                </div>
                <div class="form-group mb-3 flex flex-col flex-1">
                    <label for="contact_lastname" class="pl-1">Lastname</label>
                    <input class="form-control rounded p-1" name="contact_surname" required />
                </div>
            </div>
            <div class="form-group mb-3 flex flex-col">
                <label for="contact_query" class="pl-1">Your query</label>
                <textarea rows="3" class="form-control rounded p-1 max-h-[100px]" name="contact_query" required></textarea>
            </div>
            <div class="form-group mb-1">
                <div class="checkbox">
                    <label class="ml-1">
                        <input type="checkbox" name="remember" class="h-[20px] w-[20px] align-sub cursor-pointer"> Send me a confirmation
                    </label>
                </div>
            </div>
        </form>
    </div>
    <div class="flex justify-center gap-[4px]">
        <button class="app-btn app-btn-secondary" x-ref="closeContactUsModal" @click="$store.globalStates.modalShowing = false; showContactUsModal = false;">Close</button>
        <button class="app-btn app-btn-primary">Send</button>
    </div>
</div>