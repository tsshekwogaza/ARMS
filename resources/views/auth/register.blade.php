<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - RentReceipt</title>
    @vite(['resources/css/app.css', 'resources/js/registerMessage.js'])
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
            <a href="/" class="flex items-center gap-3">
                <img src="{{ asset('android-chrome-192x192.png') }}" class="h-11 w-11 rounded-xl bg-emerald-500/10 border border-emerald-500/20 backdrop-blur-md flex items-center justify-center text-emerald-400 font-bold text-xl shadow-inner">
                
                <span class="text-xl font-bold tracking-tight text-white">RentReceipt</span>
            </a>
        </div>

        <!-- Center Hero Text & Glass Card Visual -->
        <div class="relative z-10 my-auto max-w-xl space-y-8">
            <div class="space-y-4">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-semibold uppercase tracking-wider">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                    Get Started Free
                </span>
                <h1 class="text-4xl xl:text-5xl font-extrabold tracking-tight leading-[1.15]">
                    Start issuing digital receipts <br>
                    <span class="bg-linear-to-r from-white via-slate-200 to-emerald-400 bg-clip-text text-transparent">
                        in under 2 minutes.
                    </span>
                </h1>
                <p class="text-slate-400 text-base xl:text-lg leading-relaxed">
                    Set up your workspace by creating an account, then add your properties and tenants, and start issuing PDF receipts directly to your tenants via WhatsApp.
                </p>
            </div>

            <!-- Onboarding Step Preview Card -->
            <div class="p-5 rounded-2xl bg-white/3 border border-white/10 backdrop-blur-xl shadow-2xl space-y-4">
                <div class="flex items-center justify-between text-xs text-slate-300 font-medium">
                    <span>Workspace Setup Progress</span>
                    <span class="text-emerald-400 font-bold">Step 1 of 3</span>
                </div>
                <div class="w-full bg-slate-800 h-2 rounded-full overflow-hidden">
                    <div class="bg-emerald-500 h-full w-1/3 rounded-full"></div>
                </div>
                <div class="grid grid-cols-3 gap-2 pt-1 text-[11px] text-slate-400 text-center">
                    <span class="text-emerald-400 font-semibold">1. Create Account</span>
                    <span>2. Add Property</span>
                    <span>3. Add Tenant</span>
                </div>
            </div>
        </div>

        <!-- Footer Info -->
        <div class="relative z-10 flex items-center gap-6 text-xs text-slate-400 pt-6">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Unlimited Receipt Generation
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                WhatsApp Direct Link
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Secure Cloud Records
            </div>
        </div>

    </div>

    <!-- RIGHT PANEL (5 Cols) -->
    <div class="lg:col-span-5 flex items-center justify-center p-6 sm:p-12 bg-slate-900">

        <div class="w-full max-w-md space-y-8">

            <!-- Mobile Logo -->
            <div class="lg:hidden text-center space-y-3">
                <img src="{{ asset('android-chrome-192x192.png') }}"class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xl font-bold">
                  
                <h2 class="text-2xl font-bold text-white">RentReceipt</h2>
            </div>

            <!-- Header -->
            <div class="text-center space-y-2">
                <h2 class="text-3xl font-extrabold text-white tracking-tight">Create your account</h2>
                <p class="text-sm text-slate-400">Join landlords managing their rent billing seamlessly.</p>
            </div>

            <!-- Form Card -->
            <div class="rounded-3xl border border-white/10 bg-white/2 backdrop-blur-2xl p-8 shadow-2xl shadow-black/50">

                <form id="registerForm" action="{{ route('register') }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- Name Field -->
                    <div class="space-y-2">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300">
                            Full Name
                        </label>
                        <input type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="e.g. Aliyu Mohammed" class="w-full rounded-xl border border-white/10 bg-slate-950/60 px-4 py-3 text-sm text-white placeholder-slate-500 transition duration-200 focus:border-emerald-500 focus:bg-slate-950 focus:outline-none focus:ring-2 focus:ring-emerald-500/20">
                        @error('name')
                            <p class="text-xs text-rose-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="space-y-2">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300">
                            Email Address
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="landlord@example.com" class="w-full rounded-xl border border-white/10 bg-slate-950/60 px-4 py-3 text-sm text-white placeholder-slate-500 transition duration-200 focus:border-emerald-500 focus:bg-slate-950 focus:outline-none focus:ring-2 focus:ring-emerald-500/20">
                        @error('email')
                            <p class="text-xs text-rose-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-2">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300">
                            Password
                        </label>
                        <input type="password" name="password" required minlength="8" placeholder="••••••••" class="w-full rounded-xl border border-white/10 bg-slate-950/60 px-4 py-3 text-sm text-white placeholder-slate-500 transition duration-200 focus:border-emerald-500 focus:bg-slate-950 focus:outline-none focus:ring-2 focus:ring-emerald-500/20">
                        @error('password')
                            <p class="text-xs text-rose-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>  
                    
                    <!-- Confirm Password Field -->
                    <div class="space-y-2">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300">
                            Confirm Password
                        </label>
                        <input type="password" name="password_confirmation" required minlength="8" placeholder="••••••••" class="w-full rounded-xl border border-white/10 bg-slate-950/60 px-4 py-3 text-sm text-white placeholder-slate-500 transition duration-200 focus:border-emerald-500 focus:bg-slate-950 focus:outline-none focus:ring-2 focus:ring-emerald-500/20">
                        @error('password_confirmation')
                            <p class="text-xs text-rose-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Terms Information -->
                    <p class="text-[11px] text-slate-400 pt-1 leading-normal">
                        By creating an account, you agree to generate digital rent receipts in compliance with local property tenancy guidelines.
                    </p>

                    <!-- Submit Button -->
                    <button id="submitBtn" type="submit" class="w-full rounded-xl bg-emerald-600 hover:bg-emerald-500 active:bg-emerald-700 py-3.5 text-sm font-bold text-white transition-all duration-200 shadow-lg shadow-emerald-600/25 cursor-pointer">
                        <span id="btnText">Create Account</span>
                    </button>
                </form>
            </div>

            <!-- Footer Sign In Link -->
            <p class="text-center text-xs text-slate-400">Already have an account?
                <a href="{{ route('login') }}" class="font-bold text-emerald-400 hover:text-emerald-300 transition-colors ml-1">
                    Sign In
                </a>
            </p>
        </div>
    </div>
</div>

</body>
</html>