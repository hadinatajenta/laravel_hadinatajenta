<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Pasien') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between mb-4">
                        <div class="flex space-x-3">
                            <select id="filterRS" class="border px-3 py-2 rounded">
                                <option value="">-- Semua RS --</option>
                                @foreach($rs as $r)
                                <option value="{{ $r->id }}">{{ $r->nama_rumah_sakit }}</option>
                                @endforeach
                            </select>
                            <input type="text" id="searchPasien" placeholder="Cari pasien..."
                                class="border px-3 py-2 rounded">
                        </div>
                        <x-add-button id="btnAddPasien">Tambah Pasien</x-add-button>
                    </div>

                    <table class="min-w-full border-collapse border border-gray-300" id="table-pasien">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-4 py-2">Nama Pasien</th>
                                <th class="border px-4 py-2">Alamat</th>
                                <th class="border px-4 py-2">Rumah Sakit</th>
                                <th class="border px-4 py-2 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $p)
                            <tr id="row-{{ $p->id }}">
                                <td class="border px-4 py-2">{{ $p->nama_pasien ?? '-' }}</td>
                                <td class="border px-4 py-2">{{ $p->alamat ?? 'belum memasukkan alamat' }}</td>
                                <td class="border px-4 py-2">{{ $p->rumah_sakit->nama_rumah_sakit ?? '-' }}</td>
                                <td class="border px-4 py-2 text-center">
                                    <button class="btnDelete text-red-600" data-id="{{ $p->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0H7m2-3h6a1 1 0 011 1v1H8V5a1 1 0 011-1z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-3">No data (データない)</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="modalAdd" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden justify-center items-center">
        <div class="bg-white w-1/3 rounded shadow p-6">
            <h2 class="text-lg font-bold mb-4">Tambah Pasien</h2>
            <form id="formAdd" method="POST" action="{{ route('pasien.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="block mb-1">Nama Pasien</label>
                    <input type="text" name="nama_pasien" class="w-full border rounded px-3 py-2">
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
                    <label class="block mb-1">Rumah Sakit</label>
                    <select name="rs_id" class="w-full border rounded px-3 py-2">
                        @foreach($rs as $r)
                        <option value="{{ $r->id }}">{{ $r->nama_rumah_sakit }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="button" id="btnClose" class="mr-2 px-4 py-2 bg-gray-400 text-white rounded">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(function() {
            $("#btnAdd").click(() => $("#modalAdd").removeClass("hidden").addClass("flex"));
            $("#btnClose").click(() => $("#modalAdd").removeClass("flex").addClass("hidden"));

            function loadPasien(filter = {}) {
                $.get("{{ route('pasien.filter') }}", filter, function(res) {
                    let rows = "";
                    if (res.length) {
                        $.each(res, (i, p) => {
                            rows += `
                                <tr id="row-${p.id}">
                                    <td class="border px-4 py-2">${p.nama_pasien}</td>
                                    <td class="border px-4 py-2">${p.alamat}</td>
                                    <td class="border px-4 py-2">${p.rumah_sakit.nama_rumah_sakit}</td>
                                    <td class="border px-4 py-2 text-center">
                                        <button class="btnDelete text-red-500 px-3 py-1 rounded" data-id="${p.id}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0H7m2-3h6a1 1 0 011 1v1H8V5a1 1 0 011-1z" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>`;
                        });
                    } else {
                        rows = `<tr><td colspan="5" class="text-center py-3">No data (データない)</td></tr>`;
                    }
                    $("#table-pasien tbody").html(rows);
                });
            }

            $("#filterRS").change(function() {
                loadPasien({
                    rs_id: $(this).val(),
                    q: $("#searchPasien").val()
                });
            });

            $("#searchPasien").keyup(function() {
                loadPasien({
                    q: $(this).val(),
                    rs_id: $("#filterRS").val()
                });
            });

            $(document).on("click", ".btnDelete", function() {
                let id = $(this).data("id");
                if (!confirm("Yakin hapus pasien ini?")) return;
                $.ajax({
                    url: "/data-pasien/" + id,
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: () => {
                        $("#row-" + id).remove();
                        if ($("#table-pasien tbody tr").length === 0) {
                            $("#table-pasien tbody").html(`
                                <tr>
                                    <td colspan="5" class="text-center py-3">No data (データない)</td>
                                </tr>
                            `);
                        }
                    },

                    error: () => alert("Error delete, dame da yo")
                });
            });
        });
    </script>
</x-app-layout>