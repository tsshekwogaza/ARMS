<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignIn - RentReceipt</title>
    @vite(['resources/css/app.css', 'resources/js/signinMessage.js'])
</head>

<body class="min-h-screen bg-slate-950 font-sans antialiased selection:bg-emerald-500 selection:text-white">

<div class="min-h-screen grid lg:grid-cols-12">

    <!-- LEFT PANEL (7 Cols) -->
    <div class="hidden lg:flex lg:col-span-7 relative overflow-hidden bg-slate-950 text-white flex-col justify-between p-12 xl:p-16">
        <!-- Background Gradients & Effects -->
        <div class="absolute inset-0 bg-linear-to-br from-slate-950 via-slate-900 to-emerald-950/80"></div>
        <div class="absolute -top-32 -left-32 h-125 w-125 rounded-full bg-emerald-500/15 blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-0 right-0 h-125 w-125 rounded-full bg-cyan-500/10 blur-[140px] pointer-events-none"></div>
        <div class="absolute inset-0 opacity-[0.03] bg-[radial-gradient(circle_at_1px_1px,white_1px,transparent_0)] bg-size-[24px_24px] pointer-events-none"></div>

        <!-- Header / Logo -->
        <div class="relative z-10">
            <div class="flex items-center gap-3">
                <img src="{{ asset('android-chrome-192x192.png') }}" class="h-11 w-11 rounded-xl bg-emerald-500/10 border border-emerald-500/20 backdrop-blur-md flex items-center justify-center text-emerald-400 font-bold text-xl shadow-inner">
                <span class="text-xl font-bold tracking-tight text-white">RentReceipt</span>
            </div>
        </div>

        <!-- Center Hero Text & Glass Card Visual -->
        <div class="relative z-10 my-auto max-w-xl space-y-8">
            <div class="space-y-4">                
                <h1 class="text-4xl xl:text-5xl font-extrabold tracking-tight leading-[1.15]">
                    Automated rent receipts <br>
                    <span class="bg-linear-to-r from-white via-slate-200 to-emerald-400 bg-clip-text text-transparent">sent straight to WhatsApp.
                    </span>
                </h1>
                <p class="text-slate-400 text-base xl:text-lg leading-relaxed">
                    Designed specifically for property owners and managers in Abuja. Issue digitally signed receipts, track tenant leases, and send instant updates in one click.
                </p>
            </div>

            <!-- Floating UI Preview Card -->
            <div class="p-5 rounded-2xl bg-white/3 border border-white/10 backdrop-blur-xl shadow-2xl space-y-3">
                <div class="flex items-center justify-between pb-3 border-b border-white/10 text-xs">
                    <div class="flex items-center gap-2.5">
                        <div class="h-8 w-8 rounded-full bg-emerald-500/20 flex items-center justify-center text-emerald-400 font-bold">
                            ✓
                        </div>
                        <div>
                            <p class="font-semibold text-white">Receipt #RCT-ABJ-2026-089</p>
                            <p class="text-slate-400 text-[11px]">Gwarinpa Estate • Unit 4B</p>
                        </div>
                    </div>
                    <span class="px-2.5 py-1 rounded-md bg-emerald-500/20 text-emerald-300 text-[11px] font-semibold">
                        Issued
                    </span>
                </div>
                <div class="flex items-center justify-between text-xs text-slate-300 pt-1">
                    <span>Tenant: Ibrahim Musa</span>
                    <span class="font-bold text-white text-sm">₦1,500,000.00</span>
                </div>
            </div>
        </div>

        <!-- Footer Info -->
        <div class="relative z-10 flex items-center gap-6 text-xs text-slate-400 border-white/10 pt-6">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Digital Signature Stamps
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Instant PDF Downloads
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                WhatsApp Integration
            </div>
        </div>

    </div>

    <!-- RIGHT PANEL (5 Cols) -->
    <div class="lg:col-span-5 flex items-center justify-center p-6 sm:p-12 bg-slate-900">
        <div class="w-full max-w-md space-y-8">
            <!-- Mobile Logo -->
            <div class="lg:hidden text-center space-y-3">
                <img src="{{ asset('android-chrome-192x192.png') }}" class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xl font-bold">
                    
                <h2 class="text-2xl font-bold text-white">RentReceipt
                    {{-- <span class="text-emerald-400">.ng</span> --}}
                </h2>
            </div>

            <!-- Header -->
            <div class="text-left space-y-2">
                <h2 class="text-3xl font-extrabold text-white tracking-tight">Welcome back</h2>
                <p class="text-sm text-slate-400">Sign in to manage your properties and issue receipts.</p>
            </div>

            <!-- Session Status Alert -->
            @if(session('status'))
                <div class="rounded-xl border border-emerald-500/20 bg-emerald-500/10 p-4 text-xs font-medium text-emerald-400 flex items-center gap-3">
                    <svg class="w-5 h-5 shrink-0 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <!-- Form Card -->
            <div class="rounded-3xl border border-white/10 bg-white/2 backdrop-blur-2xl p-8 shadow-2xl shadow-black/50">

                <form id="loginForm" action="{{ route('login') }}" method="POST" class="space-y-5">
                    @csrf
                    <!-- Email Field -->
                    <div class="space-y-2">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300">
                            Email Address
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="landlord@example.com" class="w-full rounded-xl border border-white/10 bg-slate-950/60 px-4 py-3 text-sm text-white placeholder-slate-500 transition duration-200 focus:border-emerald-500 focus:bg-slate-950 focus:outline-none focus:ring-2 focus:ring-emerald-500/20">
                        <x-forms.error name="email"/>
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-2">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300">
                            Password
                        </label>
                        <input type="password" name="password" required placeholder="••••••••" class="w-full rounded-xl border border-white/10 bg-slate-950/60 px-4 py-3 text-sm text-white placeholder-slate-500 transition duration-200 focus:border-emerald-500 focus:bg-slate-950 focus:outline-none focus:ring-2 focus:ring-emerald-500/20">
                        <x-forms.error name="password"/>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between pt-1">
                        <label class="flex items-center gap-2 text-xs font-medium text-slate-300 cursor-pointer">
                            <input type="checkbox" name="remember" class="h-4 w-4 rounded border-white/10 bg-slate-950 text-emerald-500 focus:ring-emerald-500/20 focus:ring-offset-0">
                            Remember me
                        </label>

                        <a href="#" title="Coming soon" class="text-xs font-semibold text-emerald-400 hover:text-emerald-300 transition-colors">Forgot password?
                        </a>
                    </div>

                    <!-- Submit Button -->
                    <button id="submitBtn" type="submit" class="w-full rounded-xl bg-emerald-600 hover:bg-emerald-500 active:bg-emerald-700 py-3.5 text-sm font-bold text-white transition-all duration-200 shadow-lg shadow-emerald-600/25 cursor-pointer">
                        <span id="btnText">Sign In</span>
                    </button>
                </form>
            </div>

            <!-- Footer Sign Up Link -->
            <p class="text-center text-xs text-slate-400">Don't have an account yet?
                <a href="{{ route('register') }}" class="font-bold text-emerald-400 hover:text-emerald-300 transition-colors ml-1">Create one
                </a>
            </p>
        </div>
    </div>
</div>

</body>
</html>