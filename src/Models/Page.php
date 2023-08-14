<?php

namespace ABCreche\Printer\Models;

use ABCreche\Printer\Traits\HasStyles;
use ABCreche\Printer\Traits\HasViews;
use ABCreche\Printer\Traits\HasImages;
use ABCreche\Printer\Traits\HasWritings;

class Page
{
    use HasWritings, HasImages, HasViews, HasStyles;
}
