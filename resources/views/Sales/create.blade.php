@extends('Layouts.LayoutFull')
@push('css')

@endpush
@section('title', 'Cadastro')
@section('conteudo')


@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="container">
    <h1>Cadastro de Venda</h1>
    <form method="post" action="{{ route('sale.store') }}" class="form-horizontal form-validate">
        {{csrf_field()}}
        <div class="form-group">
            <label>Produto:</label>
            <input id="produto" class="form-control" name="produto" type="text" placeholder="Digite o nome do produto" value="{{old("produto")}}" required>
        </div>
        <div class="form-group">
            <label>Data:</label>
            <input id="data" class="form-control" name="data" type="date" placeholder="Digite a data da venda" value="{{old("data")}}" required />
        </div>
        <div class="form-group">
            <label>Valor:</label>
            <input id="valor" class="form-control" name="valor" type="number" placeholder="Digite o valor da venda" value="{{old("valor")}}" required/>
        </div>
        <div class="form-group">
            <label>Situação:</label>
            <select class="form-control" id="status" name="status" data-placeholder="Selecione o status">
                <option value="0"></option>
                <option value="1" name="status">Vendido</option>
                <option value="2" name="status">Cancelado</option>
                <option value="3" name="status">Devolvido</option>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success" style="float:right"><i class="fas fa-check-circle"></i> Cadastrar</button>
        </div>
    </form>
    <a class="btn btn-primary btn-sm" href="{{ route('sale.index') }}" role="button"><i class="fas fa-arrow-circle-left"></i> Voltar</a>
</div>

@endsection

@push('scripts')
{{-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script>
</script>
@endpush