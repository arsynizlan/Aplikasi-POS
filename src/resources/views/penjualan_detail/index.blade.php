@extends('layouts.master')

@section('title')
    Transaksi Penjualan
@endsection

@push('css')
    <style>
        #table-penjualan tbody tr:last-child {
            display: none;
        }
    </style>
@endpush

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="card mt-3 mb-3">
                <div class="table text-nowrap">
                    <div class="row">
                        <div class="card-body">
                            <form class="form-produk">
                                @csrf
                                <div class="col-lg-5">
                                    <div class="input-group">
                                        <input type="hidden" name="id_penjualan" id="id_penjualan"
                                            value="{{ $id_penjualan }}">
                                        <input type="hidden" name="id_produk" id="id_produk">
                                        <input type="text" name="kode_produk" id="kode_produk" class="form-control"
                                            placeholder="Masukan Kode Produk" aria-label="kode_produk"
                                            aria-describedby="button-addon2">
                                        <button onclick="tampilProduk()" class="btn btn-outline-primary" type="button"
                                            id="button-addon2">Cari</button>
                                    </div>
                                </div>
                            </form>
                            <table id="table-penjualan" class="table">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th width="25%">Jumlah</th>
                                        <th>Diskon</th>
                                        <th>Subtotal</th>
                                        <th width="15%"><i class="bx bxs-cog"></i></th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                </tbody>
                            </table>

                            <div class="bg-primary">
                                <div class="p-2 bg-primary border">
                                    <h1 class="card-title text-white tampil-bayar"></h1>
                                </div>
                            </div>
                            <div class="bg-info">
                                <div class="p-2 bg-info border">
                                    <h4 class="text-white tampil-terbilang"></h4>
                                </div>
                            </div>

                            <div class="row">
                                <form action="{{ route('transaksi.simpan') }}" class="form-penjualan" id="form-penjualan"
                                    method="post">
                                    @csrf
                                    <input type="hidden" name="id_penjualan" value="{{ $id_penjualan }}">
                                    <input type="hidden" name="total" id="total">
                                    <input type="hidden" name="total_item" id="total_item">
                                    <input type="hidden" name="bayar" id="bayar">
                                    <input type="hidden" name="id_member" id="id_member"
                                        value="{{ $memberSelected->id_member }}">

                                    <div class="form-group row mt-2">
                                        <label for="totalrp" class="col-lg-2 control-label">Total</label>
                                        <div class="col-lg-8">
                                            <input type="text" id="totalrp" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-2">
                                        <label for="kode_member" class="col-lg-2 control-label">Member</label>
                                        <div class="col-lg-8">
                                            <div class="input-group">
                                                <input type="text" class="form-control"
                                                    value="{{ $memberSelected->kode_member }}" id="kode_member"
                                                    placeholder="Masukan Kode Member" aria-label="member"
                                                    aria-describedby="button-addon2" ">
                                                                                <button onclick="tampilMember()" class="btn btn-outline-primary"
                                                                                    type="button" id="button-addon2">Cari</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row mt-2">
                                                                        <label for="diskon" class="col-lg-2 control-label">Diskon</label>
                                                                        <div class="col-lg-8">
                                                                            <div class="input-group input-group-merge">
                                                                                <input type="number" name="diskon" id="diskon" class="form-control"
                                                                                    value="{{ !empty($memberSelected->id_member) ? $diskon : 0 }}"
                                                                                    readonly>
                                                                                <span class="input-group-text">%</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row mt-2">
                                                                        <label for="bayar" class="col-lg-2 control-label">Bayar</label>
                                                                        <div class="col-lg-8">
                                                                            <input type="text" id="bayarrp" class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row mt-2">
                                                                        <label for="bayar" class="col-lg-2 control-label">Diterima</label>
                                                                        <div class="col-lg-8">
                                                                            <input type="text" name="diterima" id="diterima" value="{{ $penjualan->diterima ?? 0 }}"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row mt-2">
                                                                        <label for="bayar" class="col-lg-2 control-label">Kembali</label>
                                                                        <div class="col-lg-8">
                                                                            <input type="text" name="kembali" id="kembali" value="0"
                                                                                class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-grid gap-2 col-lg-9 mt-3 mb-3 mx-auto">
                                                        <button type="submit" id="btn-simpan" class="btn btn-primary btn-lg btn-simpan">Simpan
                                                            Transaksi</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    @includeIf('penjualan_detail.produk')
                                    @includeIf('penjualan_detail.member')
@endsection

@push('scripts')
    <script>
        let table, table2;

        $(function() {
            table = $('#table-penjualan').DataTable({
                    processing: true,
                    autowidth: false,
                    Bsort: false,
                    "bLengthChange": false,
                    ajax: {
                        url: '{{ route('transaksi.data', $id_penjualan) }}',
                    },
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
                            data: 'diskon'
                        },
                        {
                            data: 'subtotal'
                        },
                        {
                            data: 'aksi',
                            searchable: false,
                            sortable: false
                        },
                    ]

                })
                .on('draw.dt', function() {
                    loadForm($('#diskon').val())
                    setTimeout(() => {
                        $('#diterima').trigger('input');
                    }, 300);
                });
            table2 = $("#table-produk").DataTable();

            $(document).on('input', '.quantity', function() {
                let id = $(this).data('id');
                let jumlah = parseInt($(this).val());

                if (jumlah < 1) {
                    $(this).val(1);
                    alert('Jumlah tidak boleh kurang dari 1');
                    return;
                }
                if (jumlah > 10000) {
                    $(this).val(10000);
                    alert('Jumlah tidak boleh dari 10.000');
                    return;
                }

                $.post(`{{ url('/transaksi') }}/${id}`, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'put',
                        'jumlah': jumlah
                    })
                    .done(response => {
                        $(this).on('mouseout', function() {
                            table.ajax.reload(() => loadForm($('#diskon').val()));
                        });
                    })
                    .fail(errors => {
                        alert('Tidak dapat menyimpan data');
                        return;
                    });
            });

            $(document).on('input', '#diskon', function() {
                if ($(this).val() == "") {
                    $(this).val(0).select();
                }

                loadForm($('#diskon').val());
            });

            $('#diterima').on('input', function() {
                if ($(this).val() == "") {
                    $(this).val(0).select();

                }

                loadForm($('#diskon').val(), $(this).val());
            }).focus(function() {
                $(this).select();
            })

            $('.btn-simpan').on('click', function() {
                $('.form-penjualan').submit();
            });

        });

        function tampilProduk() {
            $('#modal-produk').modal('show');
            $('#ModalTitleAdd').text('Pilih Produk');


        }


        function hideProduk() {
            $('#modal-produk').modal('hide');
        }

        function pilihProduk(id, kode) {
            $('#id_produk').val(id);
            $('#kode_produk').val(kode);
            hideProduk();
            tambahProduk();
        }

        function tambahProduk() {
            $.post('{{ route('transaksi.store') }}', $('.form-produk').serialize())
                .done(response => {
                    $('#kode_produk').focus();
                    table.ajax.reload(() => loadForm($('#diskon').val()));
                })
                .fail(errors => {
                    alert('Tidak dapat menyimpan data');
                    return;
                });
        }

        function tampilMember() {
            $('#modal-member').modal('show');
            $('#ModalTitleAdd').text('Table Member');

        }

        function hideMember() {
            $('#modal-member').modal('hide');
        }

        function pilihMember(id, kode) {
            $('#id_member').val(id);
            $('#kode_member').val(kode);
            $('#diskon').val('{{ $diskon }}');
            loadForm($('#diskon').val());
            $('#diterima').val(0).focus().select();
            hideMember();
        }

        function deleteData(url) {
            if (confirm('Yakin ingin menghapus data terpilih?')) {
                $.post(url, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'delete'
                    })
                    .done((response) => {
                        table.ajax.reload(() => loadForm($('#diskon').val()));
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menghapus data');
                        return;
                    })
            }
        }

        function loadForm(diskon = 0, diterima = 0) {
            $('#total').val($('.total').text());
            $('#total_item').val($('.total_item').text());

            $.get(`{{ url('/transaksi/loadform') }}/${diskon}/${$('.total').text()}/${diterima}`)
                .done(response => {
                    $('#totalrp').val('Rp. ' + response.totalrp);
                    $('#bayarrp').val('Rp. ' + response.bayarrp);
                    $('#bayar').val(response.bayar);
                    $('.tampil-bayar').text('Bayar : Rp. ' + response.bayarrp);
                    $('.tampil-terbilang').text(response.terbilang);

                    $('#kembali').val('Rp.' + response.kembalirp);
                    if ($('#diterima').val() != 0) {
                        $('.tampil-bayar').text('Kembali : Rp. ' + response.kembalirp);
                        $('.tampil-terbilang').text(response.kembali_terbilang);
                    }
                })
                .fail(errors => {
                    alert('Tidak dapat menampilkan data');
                    return;
                })
        }
    </script>
@endpush
