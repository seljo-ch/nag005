<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' - '.config('app.name') : config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tiny.cloud/1/hhqrxrzqm2x8hptyhkermsbqxc6stmpinglnf071x5f77833/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

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
        <x-button label="Support - Ticket" icon="o-ticket" external link="https://support.nyffenegger.ch" class="btn-ghost btn-sm" responsive />
        <x-button label="Wissensdatenbank" icon="o-book-open" external link="https://support.nyffenegger.ch/help/de" class="btn-ghost btn-sm" responsive />
        <x-button label="TeamViewer" icon="o-question-mark-circle" external link="https://support.nyffenegger.ch" class="btn-ghost btn-sm" responsive />
        {{--  <x-button label="Notifications" icon="o-bell" link="###" class="btn-ghost btn-sm" responsive />
         <x-theme-toggle darkTheme="dracula" lightTheme="light" /> --}}

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

            <div class="divider divider-Accent"></div>
        @endif

        {{-- Activates the menu item when a route matches the `link` property --}}
        <x-menu activate-by-route active-bg-color="bg-cyan-600 text-white" >
            <x-menu-item title="Home" icon="o-home" link="/" />
            <x-menu-item title="Telefon Journal" icon="o-phone" link="/journal" />
            <x-menu-sub title="Gesprächs Notizen" icon="o-phone">
                <x-menu-item title="Gesprächs Notiz erstellen" icon="o-phone" link="/note/new" />
                <x-menu-item title="Alle Gesprächs Notizen anzeigen" icon="o-phone" link="/note" />
            </x-menu-sub>

            <x-menu-item title="SMS Versenden" icon="o-envelope" link="/sms" />

            <div class="divider divider-Accent">Admin Bereich</div>
            <x-menu-item title="Users" icon="o-users" link="/users" />
            <x-menu-sub title="Settings" icon="o-cog-6-tooth">
                <x-menu-item title="Wifi" icon="o-wifi" link="####" />
                <x-menu-item title="Archives" icon="o-archive-box" link="####" />
            </x-menu-sub>
        </x-menu>
    </x-slot:sidebar>

    {{-- The `$slot` goes here --}}
    <x-slot:content class="bg-gray-100">
        {{ $slot }}

        <x-menu-separator />
        <div class="flex flex-row-reverse">
            <p class="text-xs text-gray-500">© 2025 Nyffenegger Storenfabrik AG | ose | V1.0.1</p>
        </div>
    </x-slot:content>

</x-main>

{{--  TOAST area --}}
<x-toast />
</body>
</html>
