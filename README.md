# Generate Print Ready Document

[![Latest Version on Packagist](https://img.shields.io/packagist/v/abcreche/print.svg)](https://packagist.org/packages/abcreche/print)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE)

## Installation

You can install this package via composer using this command:

```bash
composer require abcreche/print
```

The package will automatically register itself

## Usage

This package uses "Print Document Template" classes to generate PDF that you can then print via the browser. These classes are filled with data that you position as you like. This is particularly helpful to fill in official document that rely on specific templates.

### Make Print Templates

First, make a new print document:

```bash
php artisan make:print ReceiptTemplate
```

The file can be foudn in `app/PrintTemplates`:

```
.
├── app
│   ├── PrintTemplates
│   │   ├── ReceiptTemplate.php
│
└── composer.json
```

In your controller you can generate the PDF for this print template now:

```php
<?php

namespace App\Http\Controllers;

use App\Receipt;
use ABCreche\Printer\Facades\Printer;
use App\PrintTemplates\ReceiptTemplate;

class ReceiptController extends Controller
{
    public function print(Receipt $receipt)
    {
        return Printer::download(new ReceiptTemplate($receipt), 'receipt.pdf');
    }
}
```

### Configure Print Templates

This is how your Print Template look by default:

```php
<?php

namespace App\PrintTemplates;

use App\Receipt;
use ABCreche\Printer\Printer;

class ReceiptTemplate implements PrintTemplate
{
    public function build()
    {
        return $this->write('Hello There');
    }
}
```

#### Write data

Let's write some data on the document:

```php
public function build()
{
    $this->write($receipt->number)
        ->top('10px')
        ->left('100px');

    $this->write($receipt->total)
        ->bottom('35px')
        ->right('50%');

    return $this;
}
```
You can also chain methods
```php
public function build()
{
    // Orders of direction is the same as in CSS for padding / margin properties
    return $this->write($receipt->number, '10px', null, null, '100px')
        ->write($receipt->total, null, '35px', '50%', null);
}
```

#### Orientation

You can choose the orientation of the document by setting the orientation property.

```php
// Default: portrait
// Options: 'portrait', 'landscape'
protected $orientation = 'portrait';
```

#### Page Margins

You can set the page margins.

```php
// Default: 25mm
protected $pageMargin = '25mm';
```

### Preview

You can preview any PrintTemplate by simply returning it from the controller

```php
Route::get('printer', function () {
    $receipt = App\Receipt::find(1);

    return new App\PrintTemplates\ReceiptTemplate($receipt);
});
```

Then you can use chrome dev tools to render the print version of the page

![](https://i.stack.imgur.com/7BCx7.png)

Image from [this stackoverflow post](https://stackoverflow.com/questions/9540990/using-chromes-element-inspector-in-print-preview-mode)

Then switch the dev tools to device rendering and set the dimension of the page at
- A4 : 595 x 842

Working with a preview like this will help you build your templates. When converting them to pdf, they will be exactly like the preview.

## TODO

Support:
- https://laravelpackages.net/barryvdh/laravel-snappy
- https://laravelpackages.net/nitmedia/wkhtml2pdf
- https://laravelpackages.net/spatie/browsershot
- dompdf
