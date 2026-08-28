<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Author" content="Timothy Samuel">
    <meta name="description" content="ARMS - Abuja Real-estate Management System">
    <meta name="keywords" content="Tenat, House, Rent, Landlord, Abuja, Properties, Receipt">
    <title>RentReceipt - Abuja Rent Receipts Management Solution</title>
    <link rel="icon" type="image/png" sizes="192x192 href="{{ asset('android-chrome-192x192.png') }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=1" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ asset('site.webmanifest') }}" />
    @fonts
    @vite(['resources/css/app.css', 'resources/js/share_refer.js'])
  </head>
<body class="bg-slate-950 text-slate-100 antialiased selection:bg-emerald-500 selection:text-white">

  <!-- Background Subtle Grid & Glow -->
  <div class="fixed inset-0 bg-[radial-gradient(#1e293b_1px,transparent_1px)] bg-size-[16px_16px] mask-[radial-gradient(ellipse_50%_50%_at_50%_0%,#000_70%,transparent_100%)] pointer-events-none opacity-40"></div>

  <!-- STICKY NAVBAR -->
  <header class="sticky top-0 z-50 backdrop-blur-md bg-slate-950/80 border-b border-slate-800/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 h-20 flex items-center justify-between">
      
      <!-- Brand Logo -->
      <a href="/" class="flex items-center gap-2 shrink-0">
        <img src="{{ asset('android-chrome-192x192.png') }}" class="w-8 h-8 rounded-xl bg-emerald-600 flex items-center justify-center font-bold text-white text-lg shadow-lg shadow-emerald-900/40">
         
        <div class="flex flex-col">
          <span class="font-bold text-lg text-white tracking-tight leading-none">RentReceipt</span>
          <span class="text-[10px] text-slate-400 font-medium">Landlord Workspace</span>
        </div>
      </a>

      <!-- Desktop Links -->
      <nav class="hidden md:flex items-center gap-8 text-xs font-semibold text-slate-400">
        <a href="#features" class="hover:text-white transition-colors">Features</a>
        <a href="#how-it-works" class="hover:text-white transition-colors">How It Works</a>
        <a href="#" class="hover:text-white transition-colors">Landlord Stories</a>
        <a href="#share" class="hover:text-white transition-colors">Share & Refer</a>
      </nav>

      <!-- Auth Action Buttons -->
      <div class="flex items-center gap-1">
        <a href="/login" class="text-xs sm:text-sm font-semibold text-slate-300 hover:text-white px-3 py-2 transition-colors shrink-0">
          Sign In
        </a>
        <a href="/register" class="bg-emerald-600 hover:bg-emerald-500 text-white font-semibold text-xs sm:text-sm px-4 py-2 rounded-xl shrink-0 shadow-lg shadow-emerald-900/30 transition-all">
          Register
        </a>
      </div>
    </div>
  </header>

  <main>
    <!-- HERO SECTION -->
    <section class="relative pt-10 sm:pt-20 pb-16 overflow-hidden">
      <!-- Glow effect -->
      <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-125 h-75 bg-emerald-500/20 blur-[120px] rounded-full pointer-events-none"></div>

      <div class="max-w-7xl mx-auto px-4 sm:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
          
          <!-- Hero Text (7 cols) -->
          <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
            
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-900 border border-slate-800 text-xs font-semibold text-emerald-400">
              <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
              Built specifically for landlords in Abuja
            </div>

            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-[1.15]">
              Issue rent receipts directly to tenant <span class="text-transparent bg-clip-text bg-linear-to-r from-emerald-400 to-teal-200">WhatsApp in 1-click.</span>
            </h1>

            <p class="text-sm sm:text-base text-slate-400 max-w-2xl mx-auto lg:mx-0 font-normal leading-relaxed">
              Stop manually filling paper receipt books. Manage property units, attach digital landlord signatures, and automatically send legally binding rent receipts via WhatsApp instantly.
            </p>

            <!-- Hero Action Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
              <a href="/register" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-sm px-7 py-3.5 rounded-xl shadow-xl shadow-emerald-900/40 transition-all">
                <span>Get Started Free</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
              </a>
              <a href="#how-it-works" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-slate-900 hover:bg-slate-800 border border-slate-800 text-slate-300 font-semibold text-sm px-6 py-3.5 rounded-xl transition-all">
                <svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                <span>See How It Works</span>
              </a>

              <button id="shareButton" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-slate-900 hover:bg-slate-800 border border-slate-800 text-slate-300 font-semibold text-sm px-6 py-3.5 rounded-xl transition-all">
                <svg id="shareIcon" class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 10.748l5.176-2.588M14.316 15.842l-5.176-2.588M6 16a3 3 0 100-6 3 3 0 000 6zm12-7a3 3 0 100-6 3 3 0 000 6zm0 14a3 3 0 100-6 3 3 0 000 6z"/>
                </svg>
                <span id="shareText">Share</span>
              </button>
            </div>

            <!-- Trust Badges -->
            <div class="pt-6 border-t border-slate-900 flex items-center justify-center lg:justify-start gap-6 text-xs text-slate-500 font-medium">
              <span class="flex items-center gap-1.5">
                <svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                No WhatsApp API key required
              </span>
              <span class="flex items-center gap-1.5">
                <svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                Digital Signature Stamp
              </span>
            </div>
          </div>

          <!-- Hero Graphic Card (5 cols) -->
          <div class="lg:col-span-5 relative">
            
            <!-- Simulated WhatsApp Message Card -->
            <div class="bg-slate-900 border border-slate-800 rounded-3xl p-5 shadow-2xl space-y-4 max-w-md mx-auto relative z-10">
              
              <div class="flex items-center justify-between pb-3 border-b border-slate-800">
                <div class="flex items-center gap-3">
                  <div class="w-8 h-8 rounded-full bg-emerald-500/20 text-emerald-400 font-bold flex items-center justify-center text-xs">
                    WA
                  </div>
                  <div>
                    <div class="text-xs font-bold text-white">WhatsApp Receipt Sent</div>
                    <div class="text-[10px] text-slate-400">To: Chidi Okonkwo (+234 803 123 4567)</div>
                  </div>
                </div>
                <span class="text-[10px] bg-emerald-500/10 text-emerald-400 font-semibold px-2 py-0.5 rounded-md">Delivered</span>
              </div>

              <!-- Message Bubble -->
              <div class="bg-slate-800/80 rounded-2xl p-4 text-xs text-slate-300 space-y-2 border border-slate-700/50">
                <p class="font-semibold text-white">Hello Chidi,</p>
                <p>Thank you for your rent payment for <strong>Flat 3B, Sunshine Heights (Gwarinpa)</strong>.</p>
                <p>Your official rent receipt <strong>#RCT-ABJ-2026-005</strong> has been generated and digitally signed.</p>
                
                <div class="mt-3 bg-slate-900/90 rounded-xl p-3 border border-emerald-500/30 flex items-center justify-between">
                  <div class="flex items-center gap-2">
                    <svg class="w-6 h-6 text-red-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4 0h-2V8h2v8z"/></svg>
                    <div>
                      <div class="font-bold text-white text-[11px]">Rent_Receipt_Chidi_2026.pdf</div>
                      <div class="text-[9px] text-slate-400">₦2,500,000.00 • Signed</div>
                    </div>
                  </div>
                  <span class="text-[10px] font-bold text-emerald-400 underline">View PDF</span>
                </div>
              </div>

              <div class="text-center text-[10px] text-slate-500">
                Received instantly on tenant phone via RentReceipt
              </div>

            </div>

          </div>

        </div>
      </div>
    </section>

    <!-- METRICS BAR -->
    <section class="border-y border-slate-900 bg-slate-900/40 py-10">
      <div class="max-w-7xl mx-auto px-4 sm:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
          <div>
            <div class="text-2xl sm:text-3xl font-bold text-white">₦450M+</div>
            <div class="text-xs text-slate-400 mt-1">Rent Collected & Documented</div>
          </div>
          <div>
            <div class="text-2xl sm:text-3xl font-bold text-white">1,200+</div>
            <div class="text-xs text-slate-400 mt-1">Receipts Issued in Abuja</div>
          </div>
          <div>
            <div class="text-2xl sm:text-3xl font-bold text-white">100%</div>
            <div class="text-xs text-slate-400 mt-1">WhatsApp Delivery Rate</div>
          </div>
          <div>
            <div class="text-2xl sm:text-3xl font-bold text-white">&lt; 30 Seconds</div>
            <div class="text-xs text-slate-400 mt-1">Time to Generate & Send</div>
          </div>
        </div>
      </div>
    </section>

    <!-- FEATURES SECTION -->
    <section id="features" class="py-20 max-w-7xl mx-auto px-4 sm:px-8 space-y-16">
      
      <div class="text-center max-w-2xl mx-auto space-y-3">
        <h2 class="text-xs font-bold text-emerald-400 uppercase tracking-widest">Designed for Abuja Landlords</h2>
        <p class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight">Everything you need to handle rent documentation effortlessly.</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Feature 1 -->
        <div class="bg-slate-900/60 border border-slate-800 p-8 rounded-3xl space-y-4 hover:border-emerald-500/40 transition-colors">
          <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center font-bold">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
          </div>
          <h3 class="text-lg font-bold text-white">Direct WhatsApp Delivery</h3>
          <p class="text-xs sm:text-sm text-slate-400 leading-relaxed">
            No more printing paper receipts or mailing physical documents. Your tenant gets an official PDF receipt straight in their WhatsApp inbox.
          </p>
        </div>

        <!-- Feature 2 -->
        <div class="bg-slate-900/60 border border-slate-800 p-8 rounded-3xl space-y-4 hover:border-emerald-500/40 transition-colors">
          <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center font-bold">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
          </div>
          <h3 class="text-lg font-bold text-white">Digital E-Signature Stamp</h3>
          <p class="text-xs sm:text-sm text-slate-400 leading-relaxed">
            Upload your signature once. Every PDF receipt automatically applies your official landlord signature stamp for legally recognized verification.
          </p>
        </div>

        <!-- Feature 3 -->
        <div class="bg-slate-900/60 border border-slate-800 p-8 rounded-3xl space-y-4 hover:border-emerald-500/40 transition-colors">
          <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center font-bold">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h4m-4 0V11m0 0h4m-4 0H9"/></svg>
          </div>
          <h3 class="text-lg font-bold text-white">Units & Expiry Tracker</h3>
          <p class="text-xs sm:text-sm text-slate-400 leading-relaxed">
            Keep clear track of vacant flats versus occupied apartments. Receive automated alerts 30 days before lease agreements expire.
          </p>
        </div>

      </div>
    </section>

    <!-- HOW IT WORKS SECTION -->
    <section id="how-it-works" class="py-20 bg-slate-900/30 border-t border-slate-900">
      <div class="max-w-7xl mx-auto px-4 sm:px-8 space-y-16">
        
        <div class="text-center max-w-2xl mx-auto space-y-3">
          <h2 class="text-xs font-bold text-emerald-400 uppercase tracking-widest">Simple Workflow</h2>
          <p class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight">Issue receipts in 3 quick steps.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
          
          <div class="space-y-4">
            <div class="w-10 h-10 rounded-full bg-slate-800 text-emerald-400 font-bold flex items-center justify-center mx-auto text-sm border border-slate-700">
              1
            </div>
            <h4 class="text-base font-bold text-white">Add Property & Tenant</h4>
            <p class="text-xs sm:text-sm text-slate-400 max-w-xs mx-auto">
              Enter the tenant's phone number, rent amount, and assigned property unit.
            </p>
          </div>

          <div class="space-y-4">
            <div class="w-10 h-10 rounded-full bg-slate-800 text-emerald-400 font-bold flex items-center justify-center mx-auto text-sm border border-slate-700">
              2
            </div>
            <h4 class="text-base font-bold text-white">Generate Signed PDF</h4>
            <p class="text-xs sm:text-sm text-slate-400 max-w-xs mx-auto">
              Preview the receipt in real time with automatically stamped signatures and dates.
            </p>
          </div>

          <div class="space-y-4">
            <div class="w-10 h-10 rounded-full bg-slate-800 text-emerald-400 font-bold flex items-center justify-center mx-auto text-sm border border-slate-700">
              3
            </div>
            <h4 class="text-base font-bold text-white">Dispatch via WhatsApp</h4>
            <p class="text-xs sm:text-sm text-slate-400 max-w-xs mx-auto">
              Click send to deliver the digital receipt directly to your tenant's WhatsApp.
            </p>
          </div>

        </div>

      </div>
    </section>

    <!-- CTA FOOTER BANNER -->
    <section class="py-20 max-w-7xl mx-auto px-4 sm:px-8">
      <div class="bg-linear-to-r from-emerald-900/80 via-emerald-800/50 to-slate-900 border border-emerald-500/30 rounded-3xl p-8 sm:p-14 text-center space-y-6 relative overflow-hidden">
        
        <h2 class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight max-w-2xl mx-auto">
          Ready to modernize your property management in Abuja?
        </h2>
        
        <p class="text-xs sm:text-sm text-emerald-100/80 max-w-lg mx-auto">
          Join landlords managing properties across Galadimawa, Suncity, Sunnyvale, Gwarinpa, Maitama, Jabi, and Wuse today.
        </p>

        <div>
          <a href="/register" class="inline-flex items-center gap-2 bg-white text-slate-950 font-bold text-sm px-8 py-3.5 rounded-xl shadow-xl hover:bg-slate-100 transition-all">
            <span>Create Free Account</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </a>
        </div>
      </div>

        <!-- ADDED: SHARE AND REFERRAL ACTION BAR -->
        <div id="share" class="pt-1 mt-4 text-center max-w-xl mx-auto">
          <div class="bg-slate-900/60 backdrop-blur-xs border border-slate-800/80 rounded-2xl p-4 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-left space-y-1">
              <div class="text-xs font-bold text-white flex items-center gap-1.5">
                Know other Landlords in Abuja?
              </div>
              <p class="text-[11px] text-slate-400 leading-tight">Spread the word, share RentReceipt with your friends and colleagues.</p>
            </div>
            
            <button id="shareButton" class="w-full sm:w-auto cursor-pointer inline-flex items-center justify-center gap-2 bg-slate-800 hover:bg-slate-700 active:scale-98 text-white font-semibold text-xs px-4 py-2.5 rounded-xl border border-slate-700/60 shadow-md transition-all shrink-0">
              <svg id="shareIcon" class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 10.748l5.176-2.588M14.316 15.842l-5.176-2.588M6 16a3 3 0 100-6 3 3 0 000 6zm12-7a3 3 0 100-6 3 3 0 000 6zm0 14a3 3 0 100-6 3 3 0 000 6z"/>
              </svg>
              <span id="shareText">Share & Refer</span>
            </button>
          </div>
        </div>
    </section>
  </main>

  <!-- FOOTER -->
  <footer class="border-t border-slate-900 bg-slate-950 py-10 text-xs text-slate-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
      <div>
        &copy; {{ date('Y') }} RentReceipt | Built for Abuja Property Owners.
      </div>
      <div class="flex items-center gap-6">
        <a href="#" class="hover:text-slate-300 transition-colors">Privacy Policy</a>
        <a href="#" class="hover:text-slate-300 transition-colors">Terms of Service</a>
        <a href="#" class="hover:text-slate-300 transition-colors">Support</a>
      </div>
    </div>
  </footer>
</body>
</html>