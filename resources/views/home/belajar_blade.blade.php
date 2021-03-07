<html>
    <head>
        <title>
        Belajar Blade
        </title>
    </head>
    <body>
        <p>Halo {{ $nama }}</p>
        <p>Contoh foreach</p>
        <ul>
            @foreach($daftar_hewan as $key=>$value)
                <li>{{ $key+1 }}. {{ $value }}</li>
            @endforeach
        </ul>

        <p>Contoh FOR</p>
        <ul>
            @for($i=0;$i<3;$i++)
                <li>{{ $i+1 }}. {{ $daftar_hewan[$i] }}</li>
            @endfor
        </ul>

        
        <p>Contoh FOR dan IF</p>
        <ul>
            @for($i=0;$i<3;$i++)
                @if(($i+1)%2==1)
                    <li>{{ $i+1 }}. {{ $daftar_hewan[$i] }}</li>
                @endif
            @endfor
        </ul>

        @php 

        @endphp
    </body>
</html>