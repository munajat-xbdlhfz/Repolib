{{-- Popup Language Table Data --}}
<div class="modal fade bd-example-modal-lg" id="bahasa-form" tabindex="-1" role="dialog" aria-labelledby="mylargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="background:#fff">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body table-responsive">
                <div class="form-group{{ $errors->has('bahasa') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-bahasa">{{ __('Tambah Bahasa') }}</label>
                    <input type="text" name="tambah-bahasa" id="tambah-bahasa" class="form-control form-control-alternative{{ $errors->has('bahasa') ? ' is-invalid' : '' }}" placeholder="{{ __('Masukkan Bahasa Baru') }}" value="">

                    @if ($errors->has('bahasa'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('bahasa') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="d-flex justify-content-center">
                    <button type="button" class="pilihBook btn btn-success" id="tambahBahasa" onclick="tambahBahasa()" data-dismiss="modal">Tambah</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Popup Category Table Data --}}
<div class="modal fade bd-example-modal-lg" id="kategori-form" tabindex="-1" role="dialog" aria-labelledby="mylargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="background:#fff">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body table-responsive">
                <div class="form-group{{ $errors->has('kategori') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-kategori">{{ __('Tambah kategori') }}</label>
                    <input type="text" name="tambah-kategori" id="tambah-kategori" class="form-control form-control-alternative{{ $errors->has('kategori') ? ' is-invalid' : '' }}" placeholder="{{ __('Masukkan kategori Baru') }}" value="">

                    @if ($errors->has('kategori'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('kategori') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="d-flex justify-content-center">
                    <button type="button" class="pilihBook btn btn-success" id="tambahKategori" onclick="tambahKategori()" data-dismiss="modal">Tambah</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Popup Access Table Data --}}
<div class="modal fade bd-example-modal-lg" id="akses-form" tabindex="-1" role="dialog" aria-labelledby="mylargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="background:#fff">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body table-responsive">
                <div class="form-group{{ $errors->has('akses') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-akses">{{ __('Tambah Akses') }}</label>
                    <input type="text" name="tambah-akses" id="tambah-akses" class="form-control form-control-alternative{{ $errors->has('akses') ? ' is-invalid' : '' }}" placeholder="{{ __('Masukkan Akses Baru') }}" value="">

                    @if ($errors->has('akses'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('akses') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="d-flex justify-content-center">
                    <button type="button" class="pilihBook btn btn-success" id="tambahAkses" onclick="tambahAkses()" data-dismiss="modal">Tambah</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Popup Location Table Data --}}
<div class="modal fade bd-example-modal-lg" id="lokasi-form" tabindex="-1" role="dialog" aria-labelledby="mylargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="background:#fff">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body table-responsive">
                <div class="form-group{{ $errors->has('lokasi') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-lokasi">{{ __('Tambah Lokasi') }}</label>
                    <input type="text" name="tambah-lokasi" id="tambah-lokasi" class="form-control form-control-alternative{{ $errors->has('lokasi') ? ' is-invalid' : '' }}" placeholder="{{ __('Masukkan Lokasi Baru') }}" value="">

                    @if ($errors->has('lokasi'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('lokasi') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="d-flex justify-content-center">
                    <button type="button" class="pilihBook btn btn-success" id="tambahLokasi" onclick="tambahLokasi()" data-dismiss="modal">Tambah</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Popup Classification Book Table Data --}}
<div class="modal fade bd-example-modal-lg" id="klasifikasi_buku-form" tabindex="-1" role="dialog" aria-labelledby="mylargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="background:#fff">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body table-responsive">
                <div class="form-group{{ $errors->has('klasifikasi_buku') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-klasifikasi_buku">{{ __('Tambah Klasifikasi Buku') }}</label>
                    <input type="text" name="tambah-klasifikasi_buku" id="tambah-klasifikasi_buku" class="form-control form-control-alternative{{ $errors->has('klasifikasi_buku') ? ' is-invalid' : '' }}" placeholder="{{ __('Masukkan Klasifikasi Buku Baru') }}" value="">

                    @if ($errors->has('klasifikasi_buku'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('klasifikasi_buku') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="d-flex justify-content-center">
                    <button type="button" class="pilihBook btn btn-success" id="tambahKlasifikasiBuku" onclick="tambahKlasifikasiBuku()" data-dismiss="modal">Tambah</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Popup Book Subject Table Data --}}
<div class="modal fade bd-example-modal-lg" id="subjek_buku-form" tabindex="-1" role="dialog" aria-labelledby="mylargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="background:#fff">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body table-responsive">
                <div class="form-group{{ $errors->has('subjek_buku') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-subjek_buku">{{ __('Tambah Subjek Buku') }}</label>
                    <input type="text" name="tambah-subjek_buku" id="tambah-subjek_buku" class="form-control form-control-alternative{{ $errors->has('subjek_buku') ? ' is-invalid' : '' }}" placeholder="{{ __('Masukkan Subjek Buku Baru') }}" value="">

                    @if ($errors->has('subjek_buku'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('subjek_buku') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="d-flex justify-content-center">
                    <button type="button" class="pilihBook btn btn-success" id="tambahSubjekBuku" onclick="tambahSubjekBuku()" data-dismiss="modal">Tambah</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Popup Written Form Table Data --}}
<div class="modal fade bd-example-modal-lg" id="karya_tulis-form" tabindex="-1" role="dialog" aria-labelledby="mylargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="background:#fff">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body table-responsive">
                <div class="form-group{{ $errors->has('karya_tulis') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-karya_tulis">{{ __('Tambah Bentuk Karya Tulis') }}</label>
                    <input type="text" name="tambah-karya_tulis" id="tambah-karya_tulis" class="form-control form-control-alternative{{ $errors->has('karya_tulis') ? ' is-invalid' : '' }}" placeholder="{{ __('Masukkan Bentuk Karya Tulis Baru') }}" value="">

                    @if ($errors->has('karya_tulis'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('karya_tulis') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="d-flex justify-content-center">
                    <button type="button" class="pilihBook btn btn-success" id="tambahKaryaTulis" onclick="tambahKaryaTulis()" data-dismiss="modal">Tambah</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Popup Book Type Table Data --}}
<div class="modal fade bd-example-modal-lg" id="jenis_buku-form" tabindex="-1" role="dialog" aria-labelledby="mylargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="background:#fff">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body table-responsive">
                <div class="form-group{{ $errors->has('jenis_buku') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-jenis_buku">{{ __('Tambah Jenis Buku') }}</label>
                    <input type="text" name="tambah-jenis_buku" id="tambah-jenis_buku" class="form-control form-control-alternative{{ $errors->has('jenis_buku') ? ' is-invalid' : '' }}" placeholder="{{ __('Masukkan Jenis Buku Baru') }}" value="">

                    @if ($errors->has('jenis_buku'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('jenis_buku') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="d-flex justify-content-center">
                    <button type="button" class="pilihBook btn btn-success" id="tambahJenisBuku" onclick="tambahJenisBuku()" data-dismiss="modal">Tambah</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Popup Authors Table Data --}}
<div class="modal fade bd-example-modal-lg" id="author-form" tabindex="-1" role="dialog" aria-labelledby="mylargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="background:#fff">
            <div class="modal-header">
                    <h5>Tambah Pengarang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body table-responsive">
                <div class="form-group{{ $errors->has('author') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-author">{{ __('Nama Pengarang') }}</label>
                    <input type="text" name="tambah-author" id="tambah-author" class="form-control form-control-alternative{{ $errors->has('author') ? ' is-invalid' : '' }}" placeholder="{{ __('Masukkan Nama Pengarang Baru') }}" value="">

                    @if ($errors->has('author'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('author') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="form-control-label">{{ __('Status Pengarang') }}</label>
                    <div class="d-flex pt-2">
                        <select class="form-control" name="author-status" id="author-status">
                            <option value="Primary">Primary</option>
                            <option value="Additional">Additional</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="button" class="pilihBook btn btn-success" id="tambahAuthor" onclick="tambahAuthor()" data-dismiss="modal">Tambah</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Popup Source Type Table Data --}}
<div class="modal fade bd-example-modal-lg" id="sumber-form" tabindex="-1" role="dialog" aria-labelledby="mylargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="background:#fff">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body table-responsive">
                <div class="form-group{{ $errors->has('sumber') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-sumber">{{ __('Tambah Jenis Sumber') }}</label>
                    <input type="text" name="tambah-sumber" id="tambah-sumber" class="form-control form-control-alternative{{ $errors->has('sumber') ? ' is-invalid' : '' }}" placeholder="{{ __('Masukkan Jenis Sumber Baru') }}" value="">

                    @if ($errors->has('sumber'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('sumber') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="d-flex justify-content-center">
                    <button type="button" class="pilihBook btn btn-success" id="tambahSumber" onclick="tambahSumber()" data-dismiss="modal">Tambah</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Popup Currency Table Data --}}
<div class="modal fade bd-example-modal-lg" id="currency-form" tabindex="-1" role="dialog" aria-labelledby="mylargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="background:#fff">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body table-responsive">
                <div class="form-group{{ $errors->has('code') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-code">{{ __('Kode Mata Uang (ISO Currency Codes)') }}</label>
                    <input type="text" name="tambah-code" id="tambah-code" class="form-control form-control-alternative{{ $errors->has('code') ? ' is-invalid' : '' }}" placeholder="{{ __('Masukkan Kode Mata Uang') }}" value="">

                    @if ($errors->has('code'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('code') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('currency') ? ' has-danger' : '' }}">
                    <label class="form-control-label pt-4" for="input-currency">{{ __('Mata Uang') }}</label>
                    <input type="text" name="tambah-currency" id="tambah-currency" class="form-control form-control-alternative{{ $errors->has('currency') ? ' is-invalid' : '' }}" placeholder="{{ __('Masukkan Mata Uang Baru') }}" value="">

                    @if ($errors->has('currency'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('currency') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="d-flex justify-content-center pt-3">
                    <button type="button" class="pilihBook btn btn-success" id="tambahCurrency" onclick="tambahCurrency()" data-dismiss="modal">Tambah</button>
                </div>
            </div>
        </div>
    </div>
</div>