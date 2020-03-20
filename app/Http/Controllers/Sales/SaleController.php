<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Http\Requests\SaleStoreRequest;
use App\Http\Requests\SaleUpdateRequest;

class SaleController extends Controller
{
    public function index()
    {
        $saleModel = app(Sale::class);
        $sales = $saleModel->all();
        $mapaResumo = [];
        foreach ($sales as $chave => $valor) {
            if($valor->status==1){
                $status = 'Vendido';
            }else{
                if($valor->status==2){
                    $status = 'Cancelado';
                }else{
                    $status = 'Devolvido';
                }
            }
            if (array_key_exists($status, $mapaResumo)) {
                $qtd = $mapaResumo[$status]['qtd'];
                $valorItem = $mapaResumo[$status]['valor'];
                $novoItem = array(
                    "qtd" => $qtd+1,
                    "valor" => $valorItem + $valor->valor
                );
                //array_replace($mapaResumo[$valor->status], $novoItem);
                $mapaResumo[$status] = $novoItem;
            } else {
                $mapaResumo[$status] = [
                    'qtd' => 1,
                    'valor' => $valor->valor
                ];
            }
        }
        
        return view('Sales/index', compact('sales', 'mapaResumo'));
    }
    public function create()
    {
        return view('Sales/create');
    }
    public function store(SaleStoreRequest $request)
    {
        $data = $request->all();
        $saleModel = app(Sale::class);

        $sale = $saleModel->create([
            'produto' => $data['produto'],
            'data' => $data['data'],
            'valor' => $data['valor'],
            'status' => $data['status']
        ]);
        return redirect('/sale')->with('success', 'Venda Inserida!');
    }
    public function edit($id)
    {
        $saleModel = app(Sale::class);
        $sale = $saleModel->find($id);

        return view('Sales/edit', compact('sale'));
    }
    public function update(SaleUpdateRequest $request, $id)
    {
        $data = $request->all();
        $saleModel = app(Sale::class);
        $sale = $saleModel->find($id);
        $sale->update([
            'produto' => $data['produto'],
            'data' => $data['data'],
            'valor' => $data['valor'],
            'status' => $data['status']
        ]);
        return redirect('/sale')->with('success', 'Venda Alterada!');
    }
    public function destroy($id)
    {
        if (!empty($id)) {
            $saleModel = app(Sale::class);
            $sale = $saleModel->find($id);
            if (!empty($sale)) {
                $sale->delete();
                return response()->json([
                    'status'  => 'success',
                    'message' => 'Venda deletada com sucesso.',
                    'reload'  => true,
                ]);
            } else {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Venda não encontrada.',
                    'reload'  => true,
                ]);
            }
        } else {
            return response()->json([
                'status'  => 'error',
                'message' => 'ID não está na requisição',
                'reload'  => true,
            ]);
        }
    }
}
