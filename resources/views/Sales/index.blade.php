@extends('Layouts.LayoutFull')
@push('css')
@endpush
@section('title', 'Resumo')
@section('conteudo')
<div class="col-sm-12">

    @if(session()->get('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
</div>
<!-- Caixa de Pesquisa -->
    <form>
        <div class="row">
            <div class="col">
                <select class="form-control" id="status" name="status">
                    <option value="1" name="status">Clientes</option>
                </select>
            </div>
            <div class="col">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Período</div>
                    </div>
                    <input type="text" class="form-control" placeholder="">
                </div>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-success"><i class="fas fa-search"></i></i> </button>
            </div>
        </div>
    </form>
    <br>
<!-- Tabela -->
<div style="border: 1px solid grey; border-radius: 10px; padding: 10px;">
<h4 style="border-bottom: 1px solid grey; padding-bottom: 5px">Tabela de vendas</h4>
<a class="btn btn-success" href="{{route('sale.create')}}" role="button" style="margin:10px;float:right"><i class="fas fa-plus-circle"></i> Adicionar</a>
<table class="table table-striped table-hover">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Produto</th>
            <th scope="col">Data</th>
            <th scope="col">Valor</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sales as $sale)
        <tr>
            <td scope="row">{{$sale->id}}</td>
            <td>{{$sale->produto}}</td>
            {{-- <td>{{$sale->data}}</td> --}}
            <td>{{date('d/m/Y', strtotime($sale->data))}}</td>
            <td>{{$sale->valor}}</td>
            <td>
                <a class="btn btn-warning btn-sm" href="{{ route('sale.edit', $sale->id)}}" role="button"><i class="fas fa-edit"></i> Editar</a>
                <span data-url="{{ route('sale.destroy',[ $sale->id]) }}" data-idClient='{{ $sale->id}}' class="btn btn-danger btn-sm text-white deleteButton">
                    <i class="fas fa-trash-alt"></i>
                    <span class='d-none d-md-inline'> Deletar</span>
                </span>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
<div style="border: 1px solid grey; border-radius: 10px; padding: 10px; margin-top:15px">
<h4 style="border-bottom: 1px solid grey; padding-bottom: 5px">Resultado das vendas</h4>
<table class="table table-striped table-hover">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Status</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Valor total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($mapaResumo as $chave=>$resumo)
            <tr>
                <td scope="row">{{$chave}}</td>
                <td scope="row">{{$resumo['qtd']}}</td>
                <td scope="row">{{$resumo['valor']}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection

@push('scripts')

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script>

$('.deleteButton').on('click', function (e) { 
        result = confirm('Tem certeza?');
        
        if(result==false){
            return;
        }
        var url = $(this).data('url');
        var idClient = $(this).data('idClient');
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            method: 'DELETE',
            url: url
        });
        $.ajax({
            data: {
                'idClient': idClient,
            },
            success: function (data) {
                console.log(data);
                if (data['status'] ?? '' == 'success') {
                    if (data['reload'] ?? '') {
                        location.reload();
                    }
                } else {
                   console.log('error');
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
</script>

@endpush