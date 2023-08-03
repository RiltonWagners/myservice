@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="pricing-header text-center">    
                <span style="color:#fe5002;font-weight: bold;font-size:25px">Cadastre-se</span>
            </div>
        </div>
        <div class="col-md-8">
            <div class="">
                <div class="card-body">
                    <div class="form-group">
                        <div class="card-deck">
                            <div class="card" style="box-shadow: 0 0 5px #fbb400;">
                                <div class="card-body">
                                    <h5 class="card-title" style="text-align: -webkit-center;font-weight: bold;">Para você</h5>
                                    <p class="card-text">Para quem procura profissionais de confiança em diversas áreas.</p>
                                    <p class="card-text">Ao se cadastrar você terá a possibilidade de descrever detalhadamente o tipo de serviço que está necessitando.</p>
                                    <p class="card-text">Cadastre-se grátuitamente e publique já o que você precisa!</p>
                                </div>
                                <div class="card-body list-group">
                                    <a href="{{ route('register.index') }}" class='btn btn-success' style="background-color: #fbb400;border-color: #fbb400;">Cadastrar</a>
                                </div>
                            </div>
                            <div class="card" style="box-shadow: 0 0 5px #ec4603;">
                                <div class="card-body">
                                    <h5 class="card-title" style="text-align: -webkit-center;font-weight: bold;">Profissional</h5>
                                    <p class="card-text">Para quem é profissional e quer conquistar novos clientes.</p>
                                    <p class="card-text">Ao se cadastrar você terá a oportunidade de expandir seus negócios, conquistar novos clientes e aumentar sua visibilidade no mercado.</p>
                                    <p class="card-text">Cadastre-se como profissional autônomo ou empresa, encontre novos trabalhos e faça o seu negócio crescer.</p>
                                </div>
                                <div class="card-body list-group">
                                    <a href="{{ route('register.index') }}" class='btn btn-success' style="background-color: #ec4603;border-color: #ec4603;">Cadastrar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection