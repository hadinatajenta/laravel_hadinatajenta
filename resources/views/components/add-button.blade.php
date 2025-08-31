<button
    id="{{ $id ?? 'btnAdd' }}"
    class="flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded shadow transition duration-200">
    <span class="text-lg">+</span> {{ $slot }}
</button>