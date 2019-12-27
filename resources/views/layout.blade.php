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
                body {
                    width: {{ $orientation == 'portrait' ? '21cm' : '29.7cm' }};
                    height: {{ $orientation == 'portrait' ? '29.7cm' : '21cm' }};
                }
                @page {
                    size: {{ $orientation == 'portrait' ? '210mm 297mm' : '297mm 210mm' }};
                    margin: {{ $pageMargin ?? '30mm 45mm 30mm 45mm' }};
                }
            }

            @media print {
                .page-break {
                    position: absolute;
                    right: 0;
                    left: 0;
                }

                @foreach ($pages as $key => $page)
                    .page-{{$key}} {
                        top: {{ ($orientation == 'portrait' ? 29.7 : 21) * $key }}cm;
                        height: {{ $orientation == 'portrait' ? 29.7 : 21 }}cm;
                    }
                @endforeach
            }

            .view {position: absolute; z-index: 1;}
            .text {position: absolute; z-index: 2;}
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

            @foreach ($views as $key => $view)
                .view-{{$key}} {
                    @foreach ($view->styles() as $attribute => $property)
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
        @foreach ($views as $key => $view)
            <div class="view view-{{ $key }}">{!! $view->html !!}</div>
        @endforeach

        @foreach ($writings as $key => $writing)
            <div class="text text-{{ $key }}">{{ $writing->text }}</div>
        @endforeach

        @foreach ($images as $key => $image)
            <img src="{{ $image->path }}" class="image image-{{ $key }}">
        @endforeach

        @foreach ($pages as $key => $page)
            <div class="page-break page-{{ $key }}"></div>
        @endforeach
    </body>
</html>
