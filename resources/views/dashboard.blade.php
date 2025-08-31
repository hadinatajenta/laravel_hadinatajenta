<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data RS') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Header + Search -->
                   <!-- Responsive Table Header -->
<div class="flex flex-col space-y-4 md:space-y-0 md:flex-row md:justify-between md:items-center mb-6">
    <!-- Title -->
    <h2 class="text-xl font-bold text-gray-800 md:text-2xl">Daftar Rumah Sakit</h2>
    
    <!-- Search & Add Button Container -->
    <div class="flex flex-col space-y-3 md:space-y-0 md:flex-row md:space-x-3 md:items-center">
        <!-- Search Input -->
        <div class="relative flex-1 md:flex-none">
            <input 
                type="text" 
                id="searchRs" 
                placeholder="Cari Rumah Sakit..." 
                class="w-full md:w-64 px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 placeholder-gray-500"
            >
            <svg class="absolute right-3 top-3 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        
        <!-- Add Button -->
        <button 
            id="btnAddRs"
            class="flex items-center justify-center w-full md:w-auto px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
        >
            <!-- Icon (always visible) -->
            <svg class="h-5 w-5 md:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <!-- Text (hidden on mobile, visible on desktop) -->
            <span class="hidden md:inline">Tambah RS</span>
            <!-- Mobile only text -->
            <span class="md:hidden ml-2">Tambah</span>
        </button>
    </div>
</div>



                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full border-collapse border border-gray-300 text-sm md:text-base">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-300 px-4 py-2">Nama Rumah Sakit</th>
                                    <th class="border border-gray-300 px-4 py-2">Alamat</th>
                                    <th class="border border-gray-300 px-4 py-2">Nomor Telepon</th>
                                    <th class="border border-gray-300 px-4 py-2">Email</th>
                                    <th class="border border-gray-300 px-4 py-2 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="rsTableBody">
                                @forelse($data as $rs)
                                <tr id="row-{{ $rs->id }}">
                                    <td class="border border-gray-300 px-4 py-2">{{ $rs->nama_rumah_sakit }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $rs->alamat }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $rs->nomor_telepon }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $rs->email }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-center">
                                        <button class="btnDelete text-red-500 px-3 py-1 rounded"
                                            data-id="{{ $rs->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 
                                                       4v6m4-6v6M9 7h6m2 0H7m2-3h6a1 1 0 011 1v1H8V5a1 1 0 011-1z" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-3">Data kosong bro (データないよ)</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="modalAdd" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden justify-center items-center">
        <div class="bg-white w-11/12 md:w-1/3 rounded shadow p-6">
            <h2 class="text-lg font-bold mb-4">Tambah Rumah Sakit</h2>
            <form id="formAdd" method="POST" action="{{ route('rs.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="block mb-1">Nama Rumah Sakit</label>
                    <input type="text" name="nama_rumah_sakit" class="w-full border rounded px-3 py-2">
                </div>
                <div class="mb-3">
                    <label class="block mb-1">Alamat</label>
                    <textarea name="alamat" class="w-full border rounded px-3 py-2"></textarea>
                </div>
                <div class="mb-3">
                    <label class="block mb-1">Nomor Telepon</label>
                    <input type="text" name="nomor_telepon" class="w-full border rounded px-3 py-2">
                </div>
                <div class="mb-3">
                    <label class="block mb-1">Email</label>
                    <input type="email" name="email" class="w-full border rounded px-3 py-2">
                </div>
                <div class="flex justify-end">
                    <button type="button" id="btnClose" class="mr-2 px-4 py-2 bg-gray-400 text-white rounded">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(function() {
            // open modal
            $("#btnAddRs").click(function() {
                $("#modalAdd").removeClass("hidden").addClass("flex");
            });
            // close modal
            $("#btnClose").click(function() {
                $("#modalAdd").removeClass("flex").addClass("hidden");
            });

            // delete data
            $(document).on("click", ".btnDelete", function() {
                let id = $(this).data("id");
                if (!confirm("Yakin mau hapus data ini?")) return;

                $.ajax({
                    url: "/data-rs/" + id,
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function() {
                        $("#row-" + id).remove();
                        alert("Data berhasil dihapus (削除したよ)");
                    },
                    error: function() {
                        alert("Error bang, dame (ダメ)!");
                    }
                });
            });

            // search
            $("#searchRs").on("keyup", function() {
                let q = $(this).val();

                $.ajax({
                    url: "{{ route('rs.search') }}",
                    type: "GET",
                    data: {
                        q
                    },
                    success: function(res) {
                        let rows = "";

                        if (res.length === 0) {
                            rows = `<tr><td colspan="5" class="text-center py-3">Data kosong bro (データないよ)</td></tr>`;
                        } else {
                            res.forEach(rs => {
                                rows += `
                                    <tr id="row-${rs.id}">
                                        <td class="border border-gray-300 px-4 py-2">${rs.nama_rumah_sakit}</td>
                                        <td class="border border-gray-300 px-4 py-2">${rs.alamat}</td>
                                        <td class="border border-gray-300 px-4 py-2">${rs.nomor_telepon}</td>
                                        <td class="border border-gray-300 px-4 py-2">${rs.email}</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">
                                            <button class="btnDelete text-red-500 px-3 py-1 rounded" data-id="${rs.id}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 
                                                           4v6m4-6v6M9 7h6m2 0H7m2-3h6a1 1 0 011 1v1H8V5a1 1 0 011-1z" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>`;
                            });
                        }

                        $("#rsTableBody").html(rows);
                    },
                    error: function() {
                        alert("Error pas cari data (検索エラーだよ)!");
                    }
                });
            });
        });
    </script>
</x-app-layout>