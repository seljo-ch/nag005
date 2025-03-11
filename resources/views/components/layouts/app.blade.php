<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' - '.config('app.name') : config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tiny.cloud/1/hhqrxrzqm2x8hptyhkermsbqxc6stmpinglnf071x5f77833/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    {{-- Flatpickr  --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/de.js"></script>

    {{-- You need to set here the default locale or any global flatpickr settings--}}
    <script>
        flatpickr.localize(flatpickr.l10ns.de);
    </script>
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
        <div><a href="/"><img src="img/logo_nag.jpg" style="height:3.0em;"/></a></div>
    </x-slot:brand>

    {{-- Right side actions --}}
    <x-slot:actions>
        <x-button label="Support - Ticket" icon="o-ticket" external link="https://support.nyffenegger.ch" class="btn-ghost btn-sm" responsive />
        <x-button label="Wissensdatenbank" icon="o-book-open" external link="https://support.nyffenegger.ch/help/de-de" class="btn-ghost btn-sm" responsive />
        <x-button label="TeamViewer" icon="o-question-mark-circle" external link="https://support.nyffenegger.ch" class="btn-ghost btn-sm" responsive />
        {{--  <x-button label="Notifications" icon="o-bell" link="###" class="btn-ghost btn-sm" responsive />
         <x-theme-toggle darkTheme="dracula" lightTheme="light" /> --}}

     </x-slot:actions>
 </x-nav>

 {{-- The main content with `full-width` --}}
<x-main with-nav full-width >

    {{-- This is a sidebar that works also as a drawer on small screens --}}
    {{-- Notice the `main-drawer` reference here --}}
    <x-slot:sidebar drawer="main-drawer" class="bg-base-300">

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
            <x-menu-item title="Telefon Journal" icon="o-phone" link="/journal" />
            <x-menu-sub title="Gesprächs Notizen" icon="o-phone" open>
                <x-menu-item title="Erstellen" icon="o-phone" link="/note/new" exact />
                <x-menu-item title="Alle anzeigen" icon="o-phone" link="/note" exact />
            </x-menu-sub>
            @hasanyrole('dispo|admin')
            <x-menu-item title="SMS Versenden" icon="o-envelope" link="/sms" />
            @endhasanyrole
            <div class="divider divider-Accent">Nagsys</div>
            <x-menu-item title="Druckaufträge" icon="o-home" link="/" />
            @hasanyrole('avor|admin')
            <div class="divider divider-Accent">Produktion</div>
            <x-menu-sub  title="DB-Sync" icon="o-home" link="/" >
                <x-menu-item title="Funktionen" icon="o-phone" link="/note/new" />
                <x-menu-item title="Protokoll" icon="o-phone" link="/note/new" />
            </x-menu-sub>
            <x-menu-item title="Reporting Neustart" icon="o-home" link="/" />
            @endhasanyrole
            @hasrole('admin')
            <div class="divider divider-Accent">Admin Bereich</div>
            <x-menu-sub title="Benutzer" icon="o-users" link="/users" >
                <x-menu-item title="Liste" icon="o-users" link="/users" exact />
                <x-menu-item title="Rollen" icon="o-wifi" link="/users/roles" exact />
                <x-menu-item title="Berechtigungen" icon="o-wifi" link="/users/roles/permissions" exact />
            </x-menu-sub>

            <x-menu-item title="DocGen neustarten" icon="o-users" link="" />
            @endhasrole
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
