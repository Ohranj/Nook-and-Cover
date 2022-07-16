document.addEventListener('alpine:init', () =>
    Alpine.store("globalStates", {
        modalShowing: false,
    })
);