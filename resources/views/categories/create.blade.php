@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                @if( Request::is('*/edit/*'))
                    <div class="card-header" style="padding-top: 10px;">
                        {{ __('Editar categoria') }}
                        <span style="float: right;font-size: smaller;">* Campo obrigatório</span>
                    </div>
                    <div class="card-body">
                        <form class="row g-3" method="POST" action="{{ route('category.update', $category->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="col-md-12">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="name" class="form-label">Nome*</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Informe o nome da categoria" value="{{ $category->name }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <a class="btn btn-outline-primary" href="javascript:void(0)" onClick="history.go(-1); return false;" role="button" style="float: left; margin-right:10px;">Voltar</a>
                                <button type="submit" class="btn btn-primary" style="float: left; padding-top: 5px;">Salvar</button>
                            </div>
                        </form>
                    </div>

                @else
                    <div class="card-header" style="padding-top: 10px;">
                        {{ __('Nova categoria') }}
                        <span style="float: right;font-size: smaller;">* Campo obrigatório</span>
                    </div>
                    <div class="card-body">
                        <form class="row g-3" method="POST" action="{{ route('category.store') }}">
                            @csrf
                            <div class="col-md-12">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="name" class="form-label">Nome*</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Informe o nome da categoria">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <a class="btn btn-outline-primary" href="javascript:void(0)" onClick="history.go(-1); return false;" role="button" style="float: left; margin-right:10px;">Voltar</a>
                                <button type="submit" class="btn btn-primary" style="float: left; padding-top: 5px;">Salvar</button>
                            </div>
                        </form>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection