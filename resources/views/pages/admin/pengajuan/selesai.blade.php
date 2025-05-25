<x-app-layout>
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Pengajuan Selesai</h4>
                    <span>data pengajuan selesai</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('jamkesda') }}">pengajuan Selesai</a></li>

                </ol>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div style="border: solid 1px #94a3b8; border-radius: 10px; padding: 15px">
                    <h5 class="my-3">Cetak Rekapitulasi Tagihan Jamkesda</h5>

                    <form action="{{ route('jamkesda.export') }}" method="POST" target="_blank">
                        <div class="row">
                            @csrf

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Tanggal awal</label>
                                    <input id="tgl_awal" type="date" name="tgl_awal"
                                        class="form-control @error('tgl_awal') is-invalid @enderror">
                                    @error('tgl_awal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Tanggal akhir</label>
                                    <input id="tgl_akhir" type="date" name="tgl_akhir"
                                        class="form-control @error('tgl_akhir') is-invalid @enderror">
                                    @error('tgl_akhir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Rumah Sakit</label>
                                    <select name="kode_rs" id="kode_rs" class="form-control @error('kode_rs') is-invalid @enderror">
                                        @if($rumahsakit)
                                            <option value="{{ $rumahsakit->kode }}">{{ $rumahsakit->nama }}</option>
                                        @else
                                            <option value="">Tidak ada rumah sakit yang tersedia</option>
                                        @endif
                                    </select>
                                    @error('kode_rs')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="keterangan">Jenis Rawat</label>
                                    <select class="form-control  @error('jenis_rawat') is-invalid @enderror" id="
                                    jenis_rawat" name="jenis_rawat">
                                        <option selected disabled>- pilih -</option>
                                        <option value="Rawat Inap">Rawat Inap</option>
                                        <option value="Rawat Jalan">Rawat Jalan</option>
                                        {{-- <option value="0">Belum Dibayar</option> --}}
                                    </select>
                                    @error('jenis_rawat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-success mt-4">Cetak</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm mb-0" id="example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pasien</th>
                                            <th>NIK</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Umur</th>
                                            <th>Rumah Sakit</th>
                                            <th>Jenis Rawat</th>
                                            <th>Status</th>
                                            <th>Status Pembayaran</th>
                                            <th>Tarif INA CBG's</th>
                                            <th>Tarif RS</th>
                                            <th>Tanggal Diterima</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="orders">
                                        @php
                                        $no = 1;
                                        @endphp
                                        @foreach ($pasien as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->nama_pasien }}</td>
                                            <td>{{ $row->no_ktp }}</td>
                                            <td>{{ $row->jenis_kelamin }}</td>
                                            <td>{{ $row->tanggal_lahir->isoFormat('D MMMM Y') }}</td>
                                            <td>{{ $row->rumahsakit->nama ?? 'Data Telah Dihapus' }}</td>
                                            <td>{{ $row->jenis_rawat }}</td>
                                            <td>
                                                @if ($row->status == 'Diterima')
                                                <a href="{{ route('jamkesda.download.diterima', ['id' => $row->pasien_id]) }}"
                                                    class="btn btn-success" target="_blank">{{ $row->status }}</a>
                                                @elseif ($row->status == 'Ditolak')
                                                <button class="btn btn-danger">{{ $row->status }}</button>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-secondary mt-1" data-toggle="modal"
                                                    data-target="#exampleModalCenter{{ $row->pasien_id }}">Lihat
                                                    Keterangan</button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModalCenter{{ $row->pasien_id }}">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Keterangan</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal"><span>&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>{{ $row->keterangan_status }}</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger light"
                                                                    data-dismiss="modal">Tutup</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($row->pembayaran)
                                                @if ($row->pembayaran->keterangan == 0)
                                                Sudah Dibayar
                                                @else
                                                Belum Dibayar
                                                @endif
                                                @else
                                                Belum Dibayar
                                                @endif
                                            </td>
                                            <td>
                                                @if ($row->pembayaran)
                                                {{ $row->pembayaran->tarif_inacbgs }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($row->pembayaran)
                                                {{ $row->pembayaran->tarif_rs }}
                                                @endif
                                            </td>
                                            <td>
                                                {{ $row->tgl_diterima }}
                                            </td>
                                            <td>
                                                {{-- <div class="d-flex"> --}}
                                                    <a href="{{ route('pengajuan.lihat', ['id' => $row->pasien_id]) }}"
                                                        class="btn btn-secondary mr-1">Lihat</a>
                                                    @if ($row->status == 'Diterima')
                                                    @if (auth()->user()->level != 'verifikator' || auth()->user()->level != 'superadmin')
                                                    @if ($row->pembayaran)
                                                    @if ($row->pembayaran->tarif_inacbgs == null)
                                                    <!-- Button trigger modal -->
                                                    <a
                                                        href="{{ route('pembayaran.buat',  ['id' => $row->pasien_id] )}}">
                                                        <button type="button" class="btn btn-primary modalpasienid" {{--
                                                            data-item="{{ $row->pasien_id }}" data-toggle="modal"
                                                            data-target="#modalTagihan" --}}>Pembayaran </button>
                                                    </a>
                                                    @else

                                                    {{-- <a href="{{ route('jamkesda.tagihan.hapus', ['id' => $row->pasien_id]) }}"
                                                        class="btn btn-danger my-2"
                                                        onclick="return confirm('Yakin untuk membatalkan data ?')">Batal</a> --}}

                                                    {{-- <a href="{{ route('jamkesda.tagihan.edit', ['id' => $row->pasien_id]) }}"
                                                        class="btn btn-warning text-white">Edit
                                                        Pembayaran</a> --}}
                                                    @endif

                                                    @else

                                                    
                                                    @endif
                                                    @else
                                                    @if ($row->pembayaran)
                                                    @if ($row->pembayaran->total_pembayaran == null)
                                                    @if (auth()->user()->level == 'verifikator' || auth()->user()->level == 'superadmin')
                                                        data-target="#modalPembayaran">Pembayaran</button> --}}
                                                    @else
                                                    <button type="button" class="btn btn-primary modalpasienid"
                                                        data-item="{{ $row->pasien_id }}" data-toggle="modal"
                                                        data-target="#modalTagihan">Pembayaran </button>
                                                    @endif
                                                    @else
                                                    <button type="button" class="btn btn-primary modalpasienid"
                                                        data-item="{{ $row->pasien_id }}" data-toggle="modal"
                                                        data-target="#modalTagihan">Pembayaran </button>
                                                    @endif
                                                    @endif
                                                    @endif
                                                    @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    $(document).on("click", ".modalpasienid", function () {
        var pasienId = $(this).data('item');
        $("#pasien_id").val(pasienId);
    });

    $(document).on("click", ".modalpasienid_pembayaran", function () {
        var pasienIdPembayaran = $(this).data('item');
        $("#pasien_id_pembayaran").val(pasienIdPembayaran);
    });
</script>