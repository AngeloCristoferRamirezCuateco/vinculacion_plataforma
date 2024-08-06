<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function generatePDF(Request $request)
    {
        $empresaId = $request->input('idInstitucion');
        $content = $request->input('content');

        $empresa = Empresa::find($empresaId); // Obtener la empresa seleccionada

        // Generar el PDF usando la vista Blade
        $pdf = Pdf::loadView('pdf.vinculacion', compact('empresa', 'content'));
        return $pdf->stream('vinculacion.pdf');
    }
}
