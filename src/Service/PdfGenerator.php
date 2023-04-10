<?php

namespace App\Service;

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfGenerator
{
    private $options;

    public function __construct()
    {
        $this->options = new Options();
        $this->options->set('defaultFont', 'Arial');
    }

    public function generateFromHtml(string $html): string
    {
        $dompdf = new Dompdf($this->options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->output();
    }
}