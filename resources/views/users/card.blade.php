<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
        .container {
            position: relative;
            text-align: center;
            color: white;
        }
        
        .centered {
            position: absolute;
            color: black;
        }
        </style>
    </head>

    <body>
        <div class="container">
            <img src="{{ asset('argon') }}/img/card.jpg" alt="" style="width:84%; max-height:100%">
            <div class="centered" style="left:39.5%; top:32.4%; font-size:14px">{{ $user->name }}</div>
            <div class="centered" style="left:39.5%; top:37.4% ; font-size:14px">{{ $user->kode_anggota }}</div>
            <div class="centered" style="left:59.7%; top:27%">
                <img style="width:86px; height:86px; border-radius:50%" src="{{ asset('storage') }}/profile/{{ $profile->foto }}" class="rounded-circle">
            </div>
        </div>
    </body>
</html>