<x-layouts.admin>

    <h1 class="text-3xl font-bold text-slate-800">
        Dashboard
    </h1>

    <div class="mt-8 grid gap-6 md:grid-cols-2">

        <div class="rounded-2xl bg-white p-6 shadow">

            <h2 class="text-lg font-semibold text-slate-500">
                Total Products
            </h2>

            <p class="mt-3 text-5xl font-bold text-slate-900">
                {{ $totalProducts }}
            </p>

        </div>

        <div class="rounded-2xl bg-white p-6 shadow">

            <h2 class="text-lg font-semibold text-slate-500">
                Featured Products
            </h2>

            <p class="mt-3 text-5xl font-bold text-slate-900">
                {{ $featuredProducts }}
            </p>

        </div>

    </div>

</x-layouts.admin>