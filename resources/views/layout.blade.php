<html>
    <head>
        <style>
            @media print {
                @page {
                    size: {{ $orientation == 'portrait' ? '210mm 297mm' : '297mm 210mm' }};
                    margin: {{ $pageMargin ?? '25mm' }};
                    margin-right: 45mm; /* for compatibility with both A4 and Letter */
                }
            }
        </style>
    </head>
</html>
