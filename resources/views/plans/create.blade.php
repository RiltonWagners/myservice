@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                @if( Request::is('*/edit/*'))
                    <div class="card-header" style="padding-top: 10px;">
                        {{ __('Editar plano') }}
                        <span style="float: right;font-size: smaller;">* Campo obrigatório</span>
                    </div>
                    <div class="card-body">
                        <form class="row g-3" method="POST" action="{{ route('plan.update', $plan->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="col-md-12">
                                <div class="row g-3">
                                    <div class="col-md-8">
                                        <label for="name" class="form-label">Nome*</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Informe o nome do plano" value="{{ $plan->name }}">
                                    </div> 
                                    <div class="col-md-4">
                                        <label for="plan" class="form-label">Status*</label>
                                        <select id="active" name="active" class="form-select">
                                            <option value="active" {{ $plan->active ? "selected='selected'" : ""}}>Ativo</option>
                                            <option value="inactive" {{ !$plan->active ? "selected='selected'" : ""}}>Inativo</option>
                                        </select>
                                    </div>                                   
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="description" class="form-label">Descrição*</label>
                                <textarea class="form-control" id="description" name="description" rows="7" placeholder="Informe a descrição do plano">{{ $plan->description }}</textarea>
                            </div>
                            <div class="col-md-4">
                                <label for="price" class="form-label">Valor*</label>
                                <input type="text" class="form-control" id="price" name="price" disabled placeholder="Informe o valor do plano" data-mask="R$ 00,00" value="{{ !empty($plan->Price[0]->price) ? 'R$ '.str_replace('.',',',$plan->Price[0]->price) : '-' }}">
                            </div>
                            <div class="col-12">
                                <a class="btn btn-outline-primary" href="javascript:void(0)" onClick="history.go(-1); return false;" role="button" style="float: left; margin-right:10px;">Voltar</a>
                                <button type="submit" class="btn btn-primary" style="float: left; padding-top: 5px;">Salvar</button>
                            </div>
                        </form>
                    </div>

                @else
                    <div class="card-header" style="padding-top: 10px;">
                        {{ __('Novo plano') }}
                        <span style="float: right;font-size: smaller;">* Campo obrigatório</span>
                    </div>
                    <div class="card-body">
                        <form class="row g-3" method="POST" action="{{ route('plan.store') }}">
                            @csrf
                            <div class="col-md-12">
                                <div class="row g-3">
                                    <div class="col-md-8">
                                        <label for="name" class="form-label">Nome*</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Informe o nome do plano">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="plan" class="form-label">Status*</label>
                                        <select id="active" name="active" class="form-select">
                                            <option value="true">Ativo</option>
                                            <option value="false">Inativo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="description" class="form-label">Descrição*</label>
                                <textarea class="form-control" id="description" name="description" rows="7" placeholder="Informe a descrição do plano"></textarea>
                            </div>                            
                            <div class="col-md-4">
                                <label for="price" class="form-label">Valor*</label>
                                <input type="text" class="form-control" id="price" name="price" placeholder="Informe o valor do plano" value="">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>

<script>
  $(document).ready(function() {
    $('#price').maskMoney({
      prefix: 'R$ ',
      thousands: '.',
      decimal: ',',
      affixesStay: true
    });
  });
</script>
@endsection