<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="InterviewPrep — AI-powered technical interview preparation platform">

    <title>{{ config('app.name', 'InterviewPrep') }}</title>

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-body-md text-on-background selection:bg-primary-container selection:text-on-primary-container antialiased flex h-screen overflow-hidden bg-background">

    <!-- Mobile Sidebar Overlay -->
    <div id="sidebar-overlay"
        class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 hidden transition-opacity duration-300 md:hidden"
        onclick="closeSidebar()">
    </div>

    <!-- SideBar Navigation -->
    @include('layouts.sidebar')

    <!-- Main Content -->
    <div class="flex-1 md:ml-64 flex flex-col h-screen overflow-hidden">
        <!-- Top App Bar -->
        @include('layouts.topbar')

        <!-- Flash Notifications -->
        @if (session('success'))
            <div id="toast-success"
                class="fixed top-4 right-4 z-50 flex items-center gap-3 bg-surface-container border border-primary/30 text-on-surface px-lg py-md rounded-xl shadow-2xl max-w-sm animate-slide-in">
                <span class="material-symbols-outlined text-primary text-[20px]" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                <p class="font-body-sm text-body-sm flex-1">{{ session('success') }}</p>
                <button onclick="document.getElementById('toast-success').remove()"
                    class="text-on-surface-variant hover:text-on-surface transition-colors">
                    <span class="material-symbols-outlined text-[18px]">close</span>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div id="toast-error"
                class="fixed top-4 right-4 z-50 flex items-center gap-3 bg-surface-container border border-error/30 text-on-surface px-lg py-md rounded-xl shadow-2xl max-w-sm animate-slide-in">
                <span class="material-symbols-outlined text-error text-[20px]" style="font-variation-settings: 'FILL' 1;">error</span>
                <p class="font-body-sm text-body-sm flex-1">{{ session('error') }}</p>
                <button onclick="document.getElementById('toast-error').remove()"
                    class="text-on-surface-variant hover:text-on-surface transition-colors">
                    <span class="material-symbols-outlined text-[18px]">close</span>
                </button>
            </div>
        @endif

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto">
            {{ $slot }}
        </main>
    </div>

    <script>
        function openSidebar() {
            document.getElementById('app-sidebar').classList.remove('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.remove('hidden');
        }
        function closeSidebar() {
            document.getElementById('app-sidebar').classList.add('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.add('hidden');
        }
        // Auto-dismiss toasts after 4s
        setTimeout(() => {
            document.getElementById('toast-success')?.remove();
            document.getElementById('toast-error')?.remove();
        }, 4000);
    </script>

    @stack('scripts')
</body>

</html>