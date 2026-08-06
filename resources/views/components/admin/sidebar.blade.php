<aside class="w-72 bg-slate-900 text-white min-h-screen">

    <div class="border-b border-slate-700 p-6">

        <h2 class="text-2xl font-bold">
            Soft Allure
        </h2>

        <p class="text-sm text-slate-400">
            Admin Panel
        </p>

    </div>

    <nav class="mt-6">

        <a href="{{ route('admin.dashboard') }}"
           class="block px-6 py-3 hover:bg-slate-800">

            Dashboard

        </a>

        <a href="{{ route('admin.products.index') }}"
           class="block px-6 py-3 hover:bg-slate-800">

            Products

        </a>

        <a href="{{ route('admin.categories.index') }}"
           class="block px-6 py-3 hover:bg-slate-800">

            Categories

        </a>

        <a href="{{ route('admin.gallery.index') }}"
           class="block px-6 py-3 hover:bg-slate-800">

            Gallery

        </a>

        <a href="{{ route('admin.contacts.index') }}"
           class="block px-6 py-3 hover:bg-slate-800">

            Contact Messages

        </a>

        <a href="{{ route('admin.settings.index') }}"
           class="block px-6 py-3 hover:bg-slate-800">

            Settings

        </a>

    </nav>

</aside>