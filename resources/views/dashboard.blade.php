<x-layouts.app>
    <form method="post" action="{{route('logout_post_url')}}">
        @csrf
        <button class="bg-indigo-500 rounded w-[125px]">Sign Out</button>
    </form>
</x-layouts.app>
