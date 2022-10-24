@extends('layouts.master')

@section('title')
    Penjualan
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row">
            <div class="card mt-3">
                <div class="table-responsive text-nowrap mt-3">
                    <table id="table-penjualan" class="table table-penjualan">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Kode Member</th>
                                <th>Total Item</th>
                                <th>Total Harga</th>
                                <th>Diskon</th>
                                <th>Total Bayar</th>
                                <th>Kasir</th>
                                <th>OPSI</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    </div>
    @includeIf('penjualan.detail')
@endsection

@push('scripts')
    <script>
        let table, table2;
        $(function() {
            table = $("#table-penjualan").DataTable({

                processing: true,
                autowidth: false,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                ajax: {
                    url: '{{ route('penjualan.data') }}',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'tanggal'
                    },
                    {
                        data: 'kode_member'
                    },
                    {
                        data: 'total_item'
                    },
                    {
                        data: 'total_harga'
                    },
                    {
                        data: 'diskon'
                    },
                    {
                        data: 'bayar'
                    },
                    {
                        data: 'kasir'
                    },
                    {
                        data: 'aksi',
                        searchable: false,
                        sortable: false
                    },
                ]

            });


            table2 = $('.table-detail').DataTable({
                processing: true,
                autowidth: false,
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'kode_produk'
                    },
                    {
                        data: 'nama_produk'
                    },
                    {
                        data: 'harga_jual'
                    },
                    {
                        data: 'jumlah'
                    },
                    {
                        data: 'subtotal'
                    }
                ]
            })

        });


        function showDetail(url) {
            $('#modal-detail').modal('show');
            $('#ModalTitleDetail').text('Detail Penjualan');

            table2.ajax.url(url);
            table2.ajax.reload();
        }


        function deleteData(url) {
            if (confirm('Yakin ingin menghapus data terpilih?')) {
                $.post(url, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'delete'
                    })
                    .done((response) => {
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menghapus data');
                        return;
                    })
            }
        }
    </script>
@endpush
