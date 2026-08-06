<x-layouts.admin>

<div class="flex items-center justify-between mb-8">

    <h1 class="text-3xl font-bold">

        Products

    </h1>

    <a
        href="{{ route('admin.products.create') }}"
        class="rounded-lg bg-indigo-600 px-5 py-3 text-white hover:bg-indigo-700">

        + Add Product

    </a>

</div>

<div class="overflow-hidden rounded-xl bg-white shadow">

<table class="min-w-full">

<thead class="bg-slate-100">

<tr>

<th class="px-6 py-4 text-left">Image</th>

<th>Name</th>

<th>Category</th>

<th>Status</th>

<th>Featured</th>

<th class="text-right pr-6">Action</th>

</tr>

</thead>

<tbody>

@foreach($products as $product)

<tr class="border-b">

<td class="px-6 py-4">

<img
src="{{ asset('storage/'.$product->image) }}"
class="h-16 w-16 rounded-lg object-cover">

</td>

<td>{{ $product->name }}</td>

<td>{{ optional($product->category)->name }}</td>

<td>

@if($product->status)

<span class="text-green-600">
Active
</span>

@else

<span class="text-red-600">
Inactive
</span>

@endif

</td>

<td>

@if($product->featured)

⭐

@endif

</td>

<td class="text-right pr-6">

<a
href="{{ route('admin.products.edit',$product) }}"
class="text-blue-600">

Edit

</a>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

<div class="mt-6">

{{ $products->links() }}

</div>

</x-layouts.admin>