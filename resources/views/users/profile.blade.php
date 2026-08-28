<x-layout title="Account Settings">
	<!-- Header -->
	<div class="mb-10 flex items-center justify-between">
			<div>
				<h1 class="text-2xl font-bold text-white tracking-tight">Account Settings</h1>
				<p class="text-slate-500 text-xs sm:text-sm mt-0.5">Manage your account information and security.</p>
			</div>
	</div>

	<form action="/users/{{ Auth::id() }}" method="POST" enctype="multipart/form-data" class="space-y-8">
		@csrf
		@method('PATCH')

		<div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
			<h2 class="mb-6 text-lg font-semibold text-slate-900">Profile</h2>

			<div class="flex flex-col gap-6 md:flex-row">
				<div class="flex flex-col items-center">
					<img src="{{ Storage::url(Auth::user()->avatar) }}" class="h-28 w-28 rounded-full border object-cover">
					<label class="mt-4 cursor-pointer rounded-lg bg-slate-100 px-4 py-2 text-sm hover:bg-slate-200">Change Photo
							<input type="file" name="avatar" class="hidden">
					</label>
					<x-forms.error name="avatar"/>
				</div>

				<div class="flex-1 space-y-5">
					<div>
						<label class="mb-1 block text-sm font-medium">Full Name</label>
						<input type="text" name="name" id="name" value="{{ Auth::user()->name }}" required class="w-full rounded-lg border px-4 py-2 focus:border-teal-500 focus:ring-2 focus:ring-teal-100">
					</div>

					<div class="grid gap-5 md:grid-cols-2">
						<div>
							<label class="mb-1 block text-sm font-medium">Email Address</label>
							<input type="email" name="email" id="email" value="{{ Auth::user()->email }}" required  class="w-full rounded-lg border px-4 py-2">
						</div>

						<div>
							<label class="mb-1 block text-sm font-medium">Phone Number</label>
							<input type="text" name="phone_number" id="phone_number" value="{{ Auth::user()->phone_number }}" required placeholder="+234..." class="w-full rounded-lg border px-4 py-2">
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Signature -->
		<div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
			<h2 class="mb-2 text-lg font-semibold">Digital Signature</h2>
			<p class="mb-6 text-sm text-slate-500">Upload your signature for approvals and generated receipts.</p>

			<div class="grid gap-6 md:grid-cols-2">
				<div>
					<label class="mb-2 block text-sm font-medium">Signature Image</label>
					<input type="file" name="signature_path" id="signature_path" class="block w-full rounded-lg border p-2">
					<x-forms.error name="signature_path"/>
				</div>

				<div>
					@if(Auth::user()->signature_path)
						<div class="rounded-xl border bg-slate-50 p-5">
							<p class="mb-4 text-sm font-medium">Current Signature</p>
							<img src="{{ Storage::url(Auth::user()->signature_path) }}" class="max-h-24">
						</div>
					@endif
				</div>
			</div>
		</div>

		<!-- Password -->
		<div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
			<h2 class="mb-2 text-lg font-semibold">Password</h2>
			<p class="mb-6 text-sm text-slate-500">Leave blank if you don't want to change your password.</p>

			<div class="grid gap-6 md:grid-cols-2">
				<div>
					<label class="mb-1 block text-sm font-medium">New Password</label>
					<input type="password" name="password" class="w-full rounded-lg border px-4 py-2">
				</div>

				<div>
					<label class="mb-1 block text-sm font-medium">Confirm Password</label>
					<input type="password" name="password_confirmation" class="w-full rounded-lg border px-4 py-2">
				</div>
			</div>
		</div>

		<!-- Account Details -->
		<div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
			<h2 class="mb-5 text-lg font-semibold">Account Information</h2>

			<div class="grid gap-6 md:grid-cols-4">
				<div>
					<p class="text-xs uppercase tracking-wider text-slate-400">User ID</p>
					<p class="mt-1">#{{ Auth::user()->id }}</p>
				</div>

				<div>
					<p class="text-xs uppercase tracking-wider text-slate-400">Registered</p>
					<p class="mt-1">{{ Auth::user()->created_at->format('d M Y') }}</p>
				</div>

				<div>
					<p class="text-xs uppercase tracking-wider text-slate-400">Last Updated</p>
					<p class="mt-1">{{ Auth::user()->updated_at->diffForHumans() }}</p>
				</div>

				<div>
					<p class="text-xs uppercase pb-1 tracking-wider text-slate-400">Email Status</p>

					@if(Auth::user()->email_verified_at)
						<span class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700">Verified</span>
					@else
						<span class="rounded-full bg-red-100 px-3 py-1 text-xs font-medium text-red-700">Not Verified</span>
					@endif
				</div>
			</div>
		</div>

		<div class="flex justify-end gap-4">
			<a href="/" class="rounded-lg border px-5 py-2.5 text-sm bg-slate-50">Cancel</a>
			
			<button type="submit" class="rounded-lg bg-teal-600 px-6 py-2.5 text-sm font-medium text-white hover:bg-teal-700">Save Changes</button>
		</div>
	</form>
</x-layout>
