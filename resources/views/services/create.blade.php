@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                @if( Request::is('*/edit/*'))
                <div class="card-header" style="padding-top: 10px;">
                    {{ __('Editar serviço') }}
                    <span style="float: right;font-size: smaller;">* Campo obrigatório</span>
                </div>
                <div class="card-body">
                    <form class="row g-3" method="POST" action="{{ route('service.update', $service->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="col-md-12">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="name" class="form-label">Nome*</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Informe o nome do serviço" value="{{ $service->name }}">
                                </div>
                                <div class="col-md-12">
                                    <label for="description" class="form-label">Descrição*</label>
                                    <input type="text" class="form-control" id="description" name="description" placeholder="Informe a descrição do serviço" value="{{ $service->description }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="category" class="form-label">Categoria*</label>
                                    <select id="id_category" name="id_category" class="form-select">
                                        <option value="" selected>Selecione a categoria</option>

                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{ $category->id == $service->id_category ? "selected='selected'" : ""}}>{{$category->name}}</option>
                                        @endforeach

                                    </select>
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
                    {{ __('Novo serviço') }}
                    <span style="float: right;font-size: smaller;">* Campo obrigatório</span>
                </div>
                <div class="card-body">
                    <form class="row g-3" method="POST" action="{{ route('service.store') }}">
                        @csrf
                        <div class="col-md-12">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="name" class="form-label">Nome*</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Informe o nome do serviço">
                                </div>
                                <div class="col-md-12">
                                    <label for="description" class="form-label">Descrição*</label>
                                    <input type="text" class="form-control" id="description" name="description" placeholder="Informe a descrição do serviço">
                                </div>
                                <div class="col-md-6">
                                    <label for="category" class="form-label">Categoria*</label>
                                    <select id="id_category" name="id_category" class="form-select">
                                        <option value="" selected>Selecione a categoria</option>

                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach

                                    </select>
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