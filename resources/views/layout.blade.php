<html>
    <head>
        <style>
            body {
                width: 100%;
                margin: 0;
                float: none;
                line-height: 1.3;
                background: #fff;
                color: #000;
                @foreach ($styles as $attribute => $property)
                    {{$attribute}} : {{$property}};
                @endforeach
            }
            @media print {
                @page {
                    size: {{ $orientation == 'portrait' ? '210mm 297mm' : '297mm 210mm' }};
                    margin: {{ $pageMargin ?? '25mm' }};
                    margin-right: 45mm; /* for compatibility with both A4 and Letter */
                }
            }

            .text {position: absolute;}

            @foreach ($writings as $key => $writing)
                .text-{{$key}} {
                    @foreach ($writing->styles() as $attribute => $property)
                        {{$attribute}} : {{$property}};
                    @endforeach
                }
            @endforeach
        </style>
    </head>
    <body style="position:relative">
        @foreach ($writings as $key => $writing)
            <div class="text text-{{ $key }}">{{ $writing->text }}</div>
        @endforeach
    </body>
</html>
