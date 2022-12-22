@extends('layouts.master')

@section('title')
    Transaksi Penjualan
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="card mt-3">
                <div class="box-body mt-3 mb-3">
                    <div class="alert alert-success alert-dismissible" role="alert">
                        Data Transaksi telah selesai!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                <div class="box-footer mb-3">
                    {{-- @if ($setting->tipe_note == 1)
                        <button type="button" class="btn btn-warning btn-warning"
                            onclick="notaKecil('{{ route('transaksi.nota_kecil') }}', 'Nota Kecil')">Cetak Nota</button>
                    @else
                        <button type="button" class="btn btn-warning btn-warning"
                            onclick="notaBesar('{{ route('transaksi.nota_besar') }}', 'NOTA BESAR')">Cetak Nota</button>
                    @endif --}}
                    <a href="{{ route('transaksi.baru') }}" class="btn btn-primary">Transaksi Baru</a>
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection

@push('scripts')
    <script>
        function notaKecil(url, title) {
            popupCenter(url, title, 720, 675);

        }

        function popupCenter(url, title, w, h) {
            const dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : window.screenX;
            const dualScreenTop = window.screenTop !== undefined ? window.screenTop : window.screenY;

            const width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document
                .documentElement.clientWidth : screen.width;
            const height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document
                .documentElement.clientHeight : screen.height;

            const systemZoom = width / window.screen.availWidth;
            const left = (width - w) / 2 / systemZoom + dualScreenLeft
            const top = (height - h) / 2 / systemZoom + dualScreenTop
            const newWindow = window.open(url, title,
                `
            scrollbars=yes,
            width  = ${w / systemZoom},
            height = ${h / systemZoom},
            top    = ${top},
            left   = ${left}
        `
            );

            if (window.focus) newWindow.focus();
        }
    </script>
@endpush
