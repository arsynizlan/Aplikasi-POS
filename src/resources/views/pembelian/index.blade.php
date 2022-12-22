@extends('layouts.master')

@section('title')
    Pembelian
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row">
            <div class="col-lg-12 order-0">
                <button onclick="addForm()" class="btn btn-primary btn-flax">Transaksi Baru</button>
                @empty(!session('id_pembelian'))
                    <a href="{{ route('pembelian_detail.index') }}" class="btn btn-info btn-flax">Transaksi Aktif</a>
                @endempty
            </div>
            <div class="card mt-3">
                <div class="table-responsive text-nowrap mt-3">
                    <table id="table-pembelian" class="table table-pembelian">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Supplier</th>
                                <th>Total Item</th>
                                <th>Total Harga</th>
                                <th>Diskon</th>
                                <th>Total Bayar</th>
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
    @includeIf('pembelian.supplier')
    @includeIf('pembelian.detail')
@endsection

@push('scripts')
    <script>
        let table, table2;
        $(function() {
            table = $("#table-pembelian").DataTable({

                processing: true,
                autowidth: false,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                ajax: {
                    url: '{{ route('pembelian.data') }}',
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
                        data: 'supplier'
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
                        data: 'aksi',
                        searchable: false,
                        sortable: false
                    },
                ]

            });

            $(".table-supplier").DataTable();

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
                        data: 'harga_beli'
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

        function addForm(url) {
            $('#modal-supplier').modal('show');
            $('#ModalTitleAdd').text('Table Supplier');
        }

        function showDetail(url) {
            $('#modal-detail').modal('show');
            $('#ModalTitleDetail').text('Detail Pembelian');

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
