<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <style>
            body {
                width: 100%;
                margin: 0;
                float: none;
                line-height: 1.3;
                background: #fff;
                color: #000;
                position: relative;
                @foreach ($styles as $attribute => $property)
                    {{$attribute}} : {{$property}};
                @endforeach
            }
            @media print {
                @page {
                    size: {{ $orientation == 'portrait' ? '210mm 297mm' : '297mm 210mm' }};
                    margin: {{ $pageMargin ?? '25mm' }};
                }
            }

            .text {position: absolute; z-index: 1;}
            .image {position: absolute; z-index: 0;}

            @foreach ($writings as $key => $writing)
                .text-{{$key}} {
                    @foreach ($writing->styles() as $attribute => $property)
                        @if (!is_null($property))
                            {{$attribute}} : {{$property}};
                        @endif
                    @endforeach
                }
            @endforeach

            @foreach ($images as $key => $image)
                .image-{{$key}} {
                    @foreach ($image->styles() as $attribute => $property)
                        @if (!is_null($property))
                            {{$attribute}} : {{$property}};
                        @endif
                    @endforeach
                }
            @endforeach
        </style>
    </head>
    <body>
        @foreach ($writings as $key => $writing)
            <div class="text text-{{ $key }}">{{ $writing->text }}</div>
        @endforeach

        @foreach ($images as $image)
            <img src="{{ $image->path }}" class="image image-{{ $key }}">
        @endforeach
    </body>
</html>
