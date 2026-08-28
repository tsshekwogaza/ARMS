@props([
    'title' => 'Dashboard - RentReceipt Abuja'
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Author" content="Timothy Samuel">
    <meta name="description" content="ARMS - Abuja Real-estate Management System">
    <meta name="keywords" content="Tenat, House, Rent, Landlord, Abuja, Properties, Receipt">
    <title>{{ $title }}</title>
    <link rel="icon" type="image/png" sizes="192x192 href="{{ asset('android-chrome-192x192.png') }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=1" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ asset('site.webmanifest') }}" />
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>

  <body class="h-full text-slate-900 font-sans antialiased selection:bg-emerald-100 selection:text-emerald-900">
    <div class="min-h-full flex bg-slate-900">

      <!-- DESKTOP SIDEBAR (Collapsible 280px -> 80px)-->
      <aside id="sidebar" class="sidebar-transition hidden lg:flex flex-col w-70 bg-slate-800 border-r border-slate-200/80 fixed inset-y-0 left-0 z-40 p-4 justify-between group" data-collapsed="false">

        <!-- Top Section -->
        <div class="space-y-6">
          
          <!-- Brand Header & Toggle Button -->
          <div class="flex items-center justify-between h-10 px-2">
            <div class="flex items-center gap-3 overflow-hidden">
              <img src="{{ asset('android-chrome-192x192.png') }}" class="w-9 h-9 shrink-0 rounded-xl bg-white text-black flex items-center justify-center font-bold text-lg ring-1 ring-slate-900/10 shadow-xs">
                
              <div class="nav-text fade-transition whitespace-nowrap overflow-hidden">
                <span class="font-bold text-white text-sm tracking-tight block">RentReceipt</span>
              </div>
            </div>
            
            <!-- Sidebar Toggle Button -->
            <button id="sidebar-toggle" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors cursor-pointer" title="Toggle Sidebar (Ctrl+B)">
              <svg id="toggle-icon" class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
              </svg>
            </button>
          </div>

          <!-- Navigation Links -->
          <nav class="space-y-1">

            @php
                $active = 'bg-emerald-50 text-emerald-800 font-semibold text-sm';
                $inactive = 'text-slate-400 hover:bg-slate-100/40 hover:text-slate-200 font-medium text-sm';
            @endphp

            <!-- Active: Dashboard -->
            <a href="{{ url('/dashboard') }}"class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl transition-all {{ request()->is('dashboard') ? $active : $inactive }}">
              <svg class="w-5 h-5 shrink-0 {{ request()->is('dashboard') ? 'text-emerald-600' : 'text-slate-200' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
              <span class="nav-text fade-transition whitespace-nowrap">Dashboard</span>
            </a>

            <!-- Properties -->
            <a href="{{ url('/properties/index') }}" class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl transition-all {{ request()->is('properties/*') ? $active : $inactive }}">
              <svg class="w-5 h-5 shrink-0 {{ request()->is('properties/*') ? 'text-emerald-600' : 'text-slate-200' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h5m-5 0V11m0 5h5"/></svg>
              <span class="nav-text fade-transition whitespace-nowrap">Properties</span>
            </a>

            <!-- Tenants -->
            <a href="{{ url('/tenants/index') }}" class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl transition-all {{ request()->is('tenants/*') ? $active : $inactive }}">
              <svg class="w-5 h-5 shrink-0 {{ request()->is('tenants/*') ? 'text-emerald-600' : 'text-slate-200' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
              <span class="nav-text fade-transition whitespace-nowrap">Tenants</span>
            </a>

            <!-- Receipts -->
            <a href="{{ url('/receipts/index') }}" class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl transition-all {{ request()->is('receipts/*') ? $active : $inactive }}">
              <svg class="w-5 h-5 shrink-0 {{ request()->is('receipts/*') ? 'text-emerald-600' : 'text-slate-200' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
              <span class="nav-text fade-transition whitespace-nowrap">Receipts</span>
            </a>

            <!-- Plans -->
            <a href="#" title="Coming Soon" class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl text-slate-400 hover:bg-slate-100/40 hover:text-slate-200 font-medium text-sm transition-all">
              <svg class="w-5 h-5 text-slate-200 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
              <span class="nav-text fade-transition whitespace-nowrap">Plans</span>
            </a>

            <!-- Reports -->
            <a href="#" title="Coming Soon" class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl text-slate-400 hover:bg-slate-100/40 hover:text-slate-200 font-medium text-sm transition-all">
              <svg class="w-5 h-5 text-slate-200 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
              <span class="nav-text fade-transition whitespace-nowrap">Reports</span>
            </a>

            <!-- Signature -->
            <a href="#" title="Coming Soon" class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl text-slate-400 hover:bg-slate-100/40 hover:text-slate-200 font-medium text-sm transition-all">
              <svg class="w-5 h-5 text-slate-200 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
              <span class="nav-text fade-transition whitespace-nowrap">Signature Config</span>
            </a>

            <!-- Settings -->
            <a href="{{ url('/users'.'/'.Auth::user()->id.'/profile') }}" class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl transition-all {{ request()->is('users/*') ? $active : $inactive }}">
              <svg class="w-5 h-5 shrink-0 {{ request()->is('users/*') ? 'text-emerald-600' : 'text-slate-200' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
              <span class="nav-text fade-transition whitespace-nowrap">Settings</span>
            </a>
          </nav>
        </div>

        <!-- Bottom User Profile Card -->
        <div class="bg-white p-2 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
          <div class="flex items-center gap-3 overflow-hidden">
            <div class="w-9 h-9 shrink-0 rounded-full bg-slate-900 text-white font-semibold flex items-center justify-center text-sm">
              <p>{{ auth()->user()->getNameInitials() }}</p>
            </div>
            <div class="truncate">
              <p class="text-xs font-bold text-slate-900 truncate">Acount</p>
              <p class="text-[11px] text-slate-500 truncate">Logout</p>
            </div>
          </div>

          <form method="POST" action="/logout">
              @csrf
              <button type="submit" class="group p-2 rounded-lg text-neutral-500 hover:text-red-600  transition-all focus-visible:outline-red-500" title="Log Out">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
              </button>  
          </form>
        </div>
      </aside>

      <!-- MAIN CONTENT AREA -->
      <div id="main-content" class="sidebar-transition flex-1 flex flex-col lg:pl-70 min-w-0 pb-28 lg:pb-12">
        
        <!-- Sticky Header -->
        <header class="sticky top-0 z-30 bg-white/80 backdrop-blur-md border-b border-slate-200/80 px-4 sm:px-8 py-3.5 flex items-center justify-between gap-4">
          
          <!-- Top Pinned Action -->
          <div class="flex items-center gap-4 flex-1 max-w-md">
            @if (!request()->is('receipts/create'))
              <div class=" space-y-3">
                <a href="{{ url('/receipts/create') }}" class="w-full flex items-center justify-center gap-2.5 bg-neutral-50/50 active:scale-[0.99] font-semibold text-sm py-2.5 px-3 rounded-xl shadow-xs shadow-emerald-600/20 cursor-pointer text-neutral-700 transition-colors hover:bg-neutral-50">
                  <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                  <span class="fade-transition whitespace-nowrap">Issue Receipt</span>
                </a>
              </div>            
            @endif
          </div>

          <!-- Profile -->
          <div class="flex items-center gap-3 shrink-0">
            <!-- Notifications -->
            <button class="p-2 text-slate-800 hover:text-slate-900 hover:bg-slate-100 rounded-xl transition-colors relative cursor-pointer" title="Notifications Coming Soon">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
              <span class="w-2 h-2 bg-emerald-500 rounded-full absolute top-2 right-2 ring-2 ring-white"></span>
            </button>
            <!-- User Avatar & Info -->
            <a href="{{ url('/users'.'/'.Auth::user()->id.'/profile') }}">
              <div class="flex items-center gap-2 rounded-lg border border-neutral-200 bg-neutral-50/50 px-1.5 py-1.5 text-sm font-medium text-neutral-700 transition-colors hover:bg-neutral-50">
                <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="Avatar" class="h-8 w-8 shrink-0 rounded-full object-cover bg-neutral-100">
                <div class="hidden sm:block text-left">
                  <p class="text-xs font-bold text-slate-900 leading-none">{{ Auth::user()->name }}</p>
                  <p class="text-[11px] text-slate-600 mt-0.5">{{ Auth::user()->email }}</p>
                </div>
              </div>
            </a>
          </div>
        </header>

        <!-- Main Body Container -->
        <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-8 py-8 space-y-8">
          {{ $slot }}
        </main>
      </div>

      <!-- MOBILE FLOATING PILL NAV BAR (< lg)        -->
      <div class="lg:hidden fixed bottom-5 left-1/2 -translate-x-1/2 z-50 w-[92%] max-w-md">
        <nav class="bg-white/90 backdrop-blur-xl border border-slate-200/80 shadow-xl rounded-full px-4 py-2 flex items-center justify-between ring-1 ring-slate-900/5">
          
          <!-- Dashboard (Active) -->
          <a href="{{ url('/dashboard') }}" class="flex flex-col items-center gap-0.5 text-slate-700 p-2">
            <svg class="w-5 h-5 {{ request()->is('dashboard') ? 'text-emerald-600' : 'text-slate-700' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
            <span class="text-[10px] font-bold">Dashboard</span>
          </a>

          <a href="{{ url('/properties/index') }}" class="flex flex-col items-center gap-0.5 text-slate-700 hover:text-slate-700 p-2">
            <svg class="w-5 h-5 {{ request()->is('properties/*') ? 'text-emerald-600' : 'text-slate-700' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10.5L12 3l9 7.5M5 9.5V21h14V9.5M9 21v-6h6v6"/></svg>
            <span class="text-[10px] font-semibold">Properties</span>
          </a>

          <!-- Center Floating Action Button -->
          <a href="{{ url('/receipts/create') }}" class="w-12 h-12 rounded-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold flex items-center justify-center -mt-6 shadow-lg shadow-emerald-600/40 ring-4 ring-slate-50 cursor-pointer active:scale-95 transition-all">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
          </a>

          <a href="{{ url('/tenants/index') }}" class="flex flex-col items-center gap-0.5 text-slate-700 hover:text-slate-700 p-2">
            <svg class="w-5 h-5 {{ request()->is('tenants/*') ? 'text-emerald-600' : 'text-slate-700' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            <span class="text-[10px] font-semibold">Tenants</span>
          </a>

          <!-- Receipts -->
          <a href="{{ url('/receipts/index') }}" class="flex flex-col items-center gap-0.5 text-slate-700 hover:text-slate-700 p-2">
            <svg class="w-5 h-5 {{ request()->is('receipts/index') ? 'text-emerald-600' : 'text-slate-700' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            <span class="text-[10px] font-semibold">Receipts</span>
          </a>

          {{-- <a href="#" class="flex flex-col items-center gap-0.5 text-slate-700 hover:text-slate-700 p-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            <span class="text-[10px] font-semibold">More</span>
          </a> --}}
          
        </nav>
      </div>
    </div>
  </body>
</html>