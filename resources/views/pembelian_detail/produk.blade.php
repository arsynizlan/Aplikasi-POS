<div class="modal fade" id="modal-produk" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">


        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalTitleAdd"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <table id="table-produk" class="table table-striped table-bordered">
                    <thead>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Harga Beli</th>
                        <th><i class='bx bxs-cog'></i></th>
                    </thead>
                    <tbody>
                        @foreach ($produk as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><span class="badge bg-info">{{ $item->kode_produk }}</span></td>
                                <td>{{ $item->nama_produk }}</td>
                                <td>{{ $item->harga_beli }}</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-xs btn-flat"
                                        onclick="pilihProduk('{{ $item->id }}','{{ $item->kode_produk }}')">
                                        <i class="fa fa-check-circle">Pilih</i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
