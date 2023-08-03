@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="card-body">
                    <div class="form-group">
                        <div class="card-deck">
                            <div class="card text-center" style="box-shadow: 0 0 5px green;">
                                <div class="card-body">
                                    <span style="color:#fe5002;font-weight: bold;font-size:25px">Meu negócio</span>
                                </div>
                                <div class="col-md-12">
                                    <div class="pricing-header text-center">
                                        <span style="font-size:18px; font-weight: bold;">Você oferece algum tipo de serviço?</span><br>
                                        <span style="font-size:18px">Aproveite a oportunidade de anunciar, destacar seu negócio e alcançar novas oportunidades!</span><br>
                                        <span style="font-size:18px">Não importa se você é um profissional autônomo, uma pequena empresa ou uma grande corporação, o nosso espaço está pronto para promover e impulsionar o seu empreendimento.</span><br>
                                        <span style="font-size:18px; font-weight: bold;">Anuncie agora mesmo e veja seu negócio prosperar.</span><br>
                                    </div>
                                </div>
                                <div class="col-md-6" style="align-self: center;">
                                    <div class="card-body list-group">
                                        <a class='btn btn-success' href="{{ route('business.create')  }}"  style="padding: 9px;font-weight: 500;font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Ubuntu,sans-serif;font-size:16px;">Cadastrar</a>
                                    </div>
                                    <div style="padding-bottom: 7px;"></div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>

@endsection