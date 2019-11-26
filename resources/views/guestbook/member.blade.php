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
              <a class="nav-link active" href="/guestbook/member">Anggota</a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="/guestbook/non-member">Non-Anggota</a>
            </li>            
            
            <li class="nav-item">
              <a class="nav-link " href="/guestbook/group">Kelompok</a>
            </li>            
          </ul>
        </div>

        <div class="card-body">
          <div class="container">
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

                <div class="col-12">
                    @if (session('fail'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('fail') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <form method="post" action="" autocomplete="off">
              @csrf

              {{-- NO. ANGGOTA --}}
              <div class="form-group{{ $errors->has('anggota') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input-anggota">{{ __('Silahkan Pindai Kartu Anggota Anda') }}</label>
                <input type="text" name="anggota" id="input-anggota" class="form-control form-control-alternative{{ $errors->has('anggota') ? ' is-invalid' : '' }}" placeholder="{{ __('No. Anggota/ Pengunjung') }}" value="" required autofocus>

                @if ($errors->has('anggota'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('anggota') }}</strong>
                    </span>
                @endif
              </div>

              <button type="submit" class="btn btn-success mt-4">{{ __('Submit') }}</button>
            </form>
          </div>
        </div>
    </div>

    <div style="margin-bottom:100%"></div>
    
   
                  
         
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>

  <footer method="post" action="" autocomplete="off">
    @csrf

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