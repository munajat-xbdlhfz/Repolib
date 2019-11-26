<!doctype html>
<html lang="en">
  <head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css') }}/style.css">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <title>Form Tamu</title>
  </head>
  <body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="pl-3">
        <a class="navbar-brand " href="/guestbook/member">
          <img style="width:130px; height:40px"  src="{{ asset('argon') }}/img/brand/blue.png"/>
        </a>
      </div>
    </nav>

    <div class="card text-left">
        <div class="card-header">
          <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
              <a class="nav-link" href="/guestbook/member">Anggota</a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="/guestbook/non-member">Non-Anggota</a>
            </li>            
            
            <li class="nav-item">
              <a class="nav-link active" href="/guestbook/group">Kelompok</a>
            </li>            
          </ul>
        </div>

        <div class="card-body">
            <div class="row">
              <div class="col-12">
                  @if (session('status'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                          {{ session('status') }}
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                  @endif
              </div>
            </div>

          <form method="post" action="" autocomplete="off">
            @csrf

            {{-- DATA INSTANSI LEMBAGA --}}
            <h6 class="heading-small text-muted mb-4">{{ __('Data Instansi Lembaga') }}</h6>
            <div class="pl-lg-4">
              {{-- NAMA INSTANSI LEMBAGA --}}
              <div class="form-group{{ $errors->has('instansi') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input-instansi">{{ __('Nama Instansi Lembaga') }}</label>
                <input type="text" name="instansi" id="input-instansi" class="form-control form-control-alternative{{ $errors->has('instansi') ? ' is-invalid' : '' }}" placeholder="{{ __('Nama Instansi Lembaga') }}" value="{{ old('instansi') }}" required autofocus>

                @if ($errors->has('instansi'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('instansi') }}</strong>
                    </span>
                @endif
              </div>

              {{-- NOMOR HP LEMBAGA --}}
              <div class="form-group{{ $errors->has('hp_lembaga') ? ' has-danger' : '' }}">
                  <label class="form-control-label" for="input-hp_lembaga">{{ __('No. HP/Telfon Lembaga') }}</label>
                  <input type="text" name="hp_lembaga" id="input-hp_lembaga" class="form-control form-control-alternative{{ $errors->has('hp_lembaga') ? ' is-invalid' : '' }}" placeholder="{{ __('No. HP/Telfon Lembaga') }}" value="{{ old('hp_lembaga') }}" required autofocus>

                  @if ($errors->has('hp_lembaga'))
                    <div class="invalid-feedback">
                      Yang Anda masukkan bukanlah nomor
                    </div>
                  @endif
              </div>

              {{-- EMAIL LEMBAGA --}}
              <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input-email">{{ __('Alamat Email Lembaga') }}</label>
                <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email Lembaga') }}" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ "Yang Anda masukkan bukan alamat email" }}</strong>
                    </span>
                @endif
              </div>

              {{-- ALAMAT INSTANSI LEMBAGA --}}
              <div class="form-group{{ $errors->has('alamat_lembaga') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input-alamat_lembaga">{{ __('Alamat Instansi Lembaga') }}</label>
                <textarea name="alamat_lembaga" id="input-alamat_lembaga" class="form-control form-control-alternative{{ $errors->has('alamat_lembaga') ? ' is-invalid' : '' }}" placeholder="{{ __('Alamat Instansi Lembaga') }}" value="{{ old('alamat_lembaga') }}" required></textarea>

                @if ($errors->has('alamat_lembaga'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('alamat_lembaga') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            {{-- DATA KETUA KELOMPOK --}}
            <h6 class="heading-small text-muted my-4">{{ __('Data Ketua Kelompok') }}</h6>
            <div class="pl-lg-4">
              {{-- NAMA --}}
              <div class="form-group{{ $errors->has('nama') ? ' has-danger' : '' }}">
                  <label class="form-control-label" for="input-nama">{{ __('Nama') }}</label>
                  <input type="text" name="nama" id="input-nama" class="form-control form-control-alternative{{ $errors->has('nama') ? ' is-invalid' : '' }}" placeholder="{{ __('Nama Penuh Ketua Kelompok') }}" value="{{ old('nama') }}" required autofocus>

                  @if ($errors->has('nama'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('nama') }}</strong>
                      </span>
                  @endif
              </div>

              {{-- NO. HP --}}
              <div class="form-group{{ $errors->has('hp') ? ' has-danger' : '' }}">
                  <label class="form-control-label" for="input-hp">{{ __('No. HP/Telfon') }}</label>
                  <input type="text" name="hp" id="input-hp" class="form-control form-control-alternative{{ $errors->has('hp') ? ' is-invalid' : '' }}" placeholder="{{ __('Np. HP/Telfon Ketua Kelompok') }}" value="{{ old('hp') }}" required autofocus>

                  @if ($errors->has('hp'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('hp') }}</strong>
                      </span>
                  @endif
              </div>
            
              {{-- PEKERJAAN --}}
              <label class="form-control-label pt-3">{{ __('Pekerjaan') }}</label>
              <div class="form-group{{ $errors->has('pekerjaan') ? ' has-danger' : '' }}">
                <div class="row">
                  @foreach ($pekerjaan as $kerja)
                    <div class="col-lg-3 col-sm-4">
                      <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="pekerjaan" id="pekerjaan" value="{{ $kerja }}" required>
                          <label class="form-check-label" style="text-transform:capitalize">{{ $kerja }}</label>
                        </div>
                    </div>
                  @endforeach
                </div>

                @if ($errors->has('pekerjaan'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('pekerjaan') }}</strong>
                  </span>
                @endif
              </div>

              {{-- PENDIDIKAN --}}
              <label class="form-control-label pt-3">{{ __('Pendidikan') }}</label>
              <div class="form-group{{ $errors->has('pendidikan') ? ' has-danger' : '' }}">
                <div class="row">
                  @foreach ($pendidikan as $pnddkn)
                    <div class="col-lg-3 col-sm-4">
                      <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="pendidikan" id="pendidikan" value="{{ $pnddkn }}" required>
                          <label class="form-check-label" style="text-transform:capitalize">{{ $pnddkn }}</label>
                        </div>
                    </div>
                  @endforeach
                </div>

                @if ($errors->has('pendidikan'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('pendidikan') }}</strong>
                  </span>
                @endif
              </div>

              {{-- JENIS KELAMIN --}}
              <label class="form-control-label pt-3">{{ __('Jenis Kelamin') }}</label>
              <div class="form-group{{ $errors->has('jenis_kelamin') ? ' has-danger' : '' }}">
                <div class="row">
                  @foreach ($jenis_kelamin as $jk)
                    <div class="col-12">
                      <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="{{ $jk }}" required>
                          <label class="form-check-label" style="text-transform:capitalize">{{ $jk }}</label>
                        </div>
                    </div>
                  @endforeach
                </div>

                @if ($errors->has('jenis_kelamin'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('jenis_kelamin') }}</strong>
                  </span>
                @endif
              </div>

              {{-- Alamat --}}
              <div class="form-group{{ $errors->has('alamat') ? ' has-danger' : '' }}">
                <label class="form-control-label pt-3" for="input-alamat">{{ __('Alamat') }}</label>
                <textarea name="alamat" id="input-alamat" class="form-control form-control-alternative{{ $errors->has('alamat') ? ' is-invalid' : '' }}" placeholder="{{ __('Alamat') }}" value="" required></textarea>

                @if ($errors->has('alamat'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('alamat') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            {{-- DATA PESERTA/ KELOMPOK --}}
            <h6 class="heading-small text-muted my-4">{{ __('Data Peserta/ Kelompok') }}</h6>
            <div class="pl-lg-4">
              {{-- JUMLAH PESERTA --}}
              <div class="form-group{{ $errors->has('peserta') ? ' has-danger' : '' }}">
                  <label class="form-control-label" for="input-peserta">{{ __('Jumlah Peserta') }}</label>
                  <input type="text" name="peserta" id="input-peserta" class="form-control form-control-alternative{{ $errors->has('peserta') ? ' is-invalid' : '' }}" placeholder="{{ __('Jumlah Peserta') }}" value="{{ old('peserta') }}" required autofocus>

                  @if ($errors->has('peserta'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('peserta') }}</strong>
                      </span>
                  @endif
              </div>
            </div>
            

            <div class="text-center mb-5">
              <button type="reset" class="btn btn-danger mt-4 mr-3">Reset</button>
              <button type="submit" class="btn btn-success mt-4">{{ __('Submit') }}</button>
            </div>
          </form>
        </div>
    </div>
    
   
                  
         
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
  
  <footer>
      <div class="footer align-items-center pt-3 pb-3">
          <div class="">
              <div class="">
                  &copy; {{ now()->year }} <a href="https://www.perpusnas.go.id/" class="font-weight-bold ml-1" target="_blank">Perpustakaan Nasional</a>
              </div>
          </div>
          <div style="font-size:15px;">
              <ul class="nav nav-footer justify-content-center justify-content-nd">
                  <li class="nav-item">
                      <a href="#" class="nav-link" target="_blank">About Us</a>
                  </li>
              </ul>
          </div>
      </div>
  </footer>
</html>     