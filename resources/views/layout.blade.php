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
                    width: {{ $orientation == 'portrait' ? '210mm' : '297mm' }};
                    height: {{ $orientation == 'portrait' ? '297mm' : '210mm' }};
                }
                @page {
                    size: {{ $orientation == 'portrait' ? '210mm 297mm' : '297mm 210mm' }};
                    margin: {{ $pageMargin ?? '10mm 10mm 10mm 10mm' }};
                }
            }

            @media print {
                .page-break {
                    position: absolute;
                    right: 0;
                    left: 0;
                }

                @foreach ($pages as $pageKey => $page)
                    .page-{{$pageKey}} {
                        top: {{ ($orientation == 'portrait' ? 297 : 210) * $pageKey }}mm;
                        height: {{ $orientation == 'portrait' ? 296 : 210 }}mm;
                    }

                    @foreach ($page->getWritings() as $key => $writing)
                        .text-{{ $pageKey }}-{{ $key }} {
                            @foreach ($writing->styles() as $attribute => $property)
                                @if (!is_null($property))
                                    {{$attribute}} : {{$property}};
                                @endif
                            @endforeach
                        }
                    @endforeach

                    @foreach ($page->getViews() as $key => $view)
                        .view-{{ $pageKey }}-{{ $key }} {
                            @foreach ($view->styles() as $attribute => $property)
                                @if (!is_null($property))
                                    {{$attribute}} : {{$property}};
                                @endif
                            @endforeach
                        }
                    @endforeach

                    @foreach ($page->getImages() as $key => $image)
                        .image-{{ $pageKey }}-{{ $key }} {
                            @foreach ($image->styles() as $attribute => $property)
                                @if (!is_null($property))
                                    {{$attribute}} : {{$property}};
                                @endif
                            @endforeach
                        }
                    @endforeach
                @endforeach
            }

            .view {position: absolute; z-index: 1;}
            .text {position: absolute; z-index: 2;}
            .image {position: absolute; z-index: 0;max-width: 100%;}
        </style>
    </head>
    <body>
        @foreach ($pages as $pageKey => $page)
            <div class="page-break page-{{ $pageKey }}">

                @foreach ($page->getViews() as $key => $view)
                    <div class="view view-{{ $pageKey }}-{{ $key }}">{!! $view->html !!}</div>
                @endforeach

                @foreach ($page->getWritings() as $key => $writing)
                    <div class="text text-{{ $pageKey }}-{{ $key }}">{{ $writing->text }}</div>
                @endforeach

                @foreach ($page->getImages() as $key => $image)
                    <img src="{{ $image->path }}" class="image image-{{ $pageKey }}-{{ $key }}">
                @endforeach

            </div>
        @endforeach
    </body>
</html>
