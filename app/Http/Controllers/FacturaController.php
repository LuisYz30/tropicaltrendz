<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\DetalleFactura;
use Barryvdh\DomPDF\Facade\Pdf;

class FacturaController extends Controller
{

public function generarPDF($id)
{
    $factura = Factura::with('user')->findOrFail($id);
    $detalles = DetalleFactura::where('factura_id', $id)->get();

    $pdf = Pdf::loadView('facturas.pdf', compact('factura', 'detalles'));
    return $pdf->download("Factura_Tropical.pdf");
}



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /** 
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * Display the specified resource.
     */
    public function show(Factura $factura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Factura $factura)
    {
        //
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Factura $factura)
    {
        //
    }
}
