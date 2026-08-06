<x-layouts.admin>

<div class="flex items-center justify-between mb-8">

    <h1 class="text-3xl font-bold">
        Categories
    </h1>

    <a href="{{ route('admin.categories.create') }}"
       class="bg-indigo-600 text-white px-5 py-3 rounded-lg">

        + Add Category

    </a>

</div>

<div class="bg-white rounded-xl shadow overflow-hidden">

<table class="min-w-full">

<thead class="bg-slate-100">

<tr>

<th class="px-6 py-4 text-left">Image</th>

<th>Name</th>

<th>Status</th>

<th class="text-right pr-6">Action</th>

</tr>

</thead>

<tbody>

@foreach($categories as $category)

<tr class="border-b">

<td class="px-6 py-4">

@if($category->image)

<img
src="{{ asset('storage/'.$category->image) }}"
class="h-16 w-16 rounded-lg object-cover">

@endif

</td>

<td>{{ $category->name }}</td>

<td>

@if($category->status)

<span class="text-green-600 font-medium">
Active
</span>

@else

<span class="text-red-600 font-medium">
Inactive
</span>

@endif

</td>

<td class="text-right pr-6">

<a
href="{{ route('admin.categories.edit',$category) }}"
class="text-blue-600 hover:underline">

Edit

</a>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

<div class="mt-6">

{{ $categories->links() }}

</div>

</x-layouts.admin>