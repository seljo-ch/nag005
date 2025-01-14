<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' - '.config('app.name') : config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

{{-- The navbar with `sticky` and `full-width` --}}
<x-nav sticky full-width>

    <x-slot:brand>
        {{-- Drawer toggle for "main-drawer" --}}
        <label for="main-drawer" class="lg:hidden mr-3">
            <x-icon name="o-bars-3" class="cursor-pointer" />
        </label>

        {{-- Brand --}}
        <div>App</div>
    </x-slot:brand>

    {{-- Right side actions --}}
    <x-slot:actions>
        <x-button label="Messages" icon="o-envelope" link="###" class="btn-ghost btn-sm" responsive />
        <x-button label="Notifications" icon="o-bell" link="###" class="btn-ghost btn-sm" responsive />
        {{--  <x-theme-toggle darkTheme="dracula" lightTheme="light" /> --}}

     </x-slot:actions>
 </x-nav>

 {{-- The main content with `full-width` --}}
<x-main with-nav full-width >

    {{-- This is a sidebar that works also as a drawer on small screens --}}
    {{-- Notice the `main-drawer` reference here --}}
    <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-300">

        {{-- User --}}
        @if($user = auth()->user())
            <x-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="pt-2">
                <x-slot:actions>
                    <x-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff" no-wire-navigate link="/logout" />
                </x-slot:actions>
            </x-list-item>

            <x-menu-separator />
        @endif

        {{-- Activates the menu item when a route matches the `link` property --}}
        <x-menu activate-by-route>
            <x-menu-item title="Home" icon="o-home" link="###" />
            <x-menu-item title="Users" icon="o-users" link="/users" />
            <x-menu-item title="Telefon Notiz" icon="o-phone" link="/note" />
            <x-menu-item title="Telefon Journal" icon="o-phone" link="/journal" />
            <x-menu-item title="SMS Versenden" icon="o-envelope" link="/sms" />
            <x-menu-sub title="Settings" icon="o-cog-6-tooth">
                <x-menu-item title="Wifi" icon="o-wifi" link="####" />
                <x-menu-item title="Archives" icon="o-archive-box" link="####" />
            </x-menu-sub>
        </x-menu>
    </x-slot:sidebar>

    {{-- The `$slot` goes here --}}
    <x-slot:content class="bg-gray-100">
        {{ $slot }}
        <div class="divider"></div>
        <div class="flex flex-row-reverse">
            <p class="text-xs text-gray-500">© 2025 Nyffenegger Storenfabrik AG | ose | V1.0.1</p>
        </div>
    </x-slot:content>

</x-main>
<footer class="footer bg-neutral text-neutral-content items-center p-4">
    <aside class="grid-flow-col items-center">
        <svg
            width="36"
            height="36"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
            fill-rule="evenodd"
            clip-rule="evenodd"
            class="fill-current">
            <path
                d="M22.672 15.226l-2.432.811.841 2.515c.33 1.019-.209 2.127-1.23 2.456-1.15.325-2.148-.321-2.463-1.226l-.84-2.518-5.013 1.677.84 2.517c.391 1.203-.434 2.542-1.831 2.542-.88 0-1.601-.564-1.86-1.314l-.842-2.516-2.431.809c-1.135.328-2.145-.317-2.463-1.229-.329-1.018.211-2.127 1.231-2.456l2.432-.809-1.621-4.823-2.432.808c-1.355.384-2.558-.59-2.558-1.839 0-.817.509-1.582 1.327-1.846l2.433-.809-.842-2.515c-.33-1.02.211-2.129 1.232-2.458 1.02-.329 2.13.209 2.461 1.229l.842 2.515 5.011-1.677-.839-2.517c-.403-1.238.484-2.553 1.843-2.553.819 0 1.585.509 1.85 1.326l.841 2.517 2.431-.81c1.02-.33 2.131.211 2.461 1.229.332 1.018-.21 2.126-1.23 2.456l-2.433.809 1.622 4.823 2.433-.809c1.242-.401 2.557.484 2.557 1.838 0 .819-.51 1.583-1.328 1.847m-8.992-6.428l-5.01 1.675 1.619 4.828 5.011-1.674-1.62-4.829z"></path>
        </svg>
        <p>Copyright © {new Date().getFullYear()} - All right reserved</p>
    </aside>
    <nav class="grid-flow-col gap-4 md:place-self-center md:justify-self-end">
        <a>
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                class="fill-current">
                <path
                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path>
            </svg>
        </a>
        <a>
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                class="fill-current">
                <path
                    d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"></path>
            </svg>
        </a>
        <a>
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                class="fill-current">
                <path
                    d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"></path>
            </svg>
        </a>
    </nav>
</footer>
{{--  TOAST area --}}
<x-toast />
</body>
</html>
