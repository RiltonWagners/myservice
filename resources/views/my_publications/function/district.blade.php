@if(!isset($district->erro))
    @csrf
    <div class="col-md-14">
        <div class="row g-3">
            <div class="col-md-3">
                <label for="state" class="form-label">Estado</label>
                <input type="text" class="form-control" id="uf" name="uf" value="{{ $state }}" disabled>
            </div>
            <div class="col-md-9">
                <label for="city" class="form-label">Município</label>
                <input type="hidden" class="form-control" id="id_city" name="id_city" value="{{ $district->ibge }}">
                <input type="text" class="form-control" id="city" name="city" value="{{ $district->localidade }}" disabled>
            </div>
            <div class="col-md-6">
                <label for="street" class="form-label">Logradouro</label>
                <div id="street"></div>
                <input type="hidden" class="form-control" id="street" name="street" value="{{ $district->logradouro }}">
                <input type="text" class="form-control" id="_street" name="_street" value="{{ $district->logradouro }}" disabled>
            </div>
            <div class="col-md-6">
                <label for="district" class="form-label">Bairro</label>
                <input type="hidden" class="form-control" id="district" name="district" value="{{ $district->bairro }}">
                <input type="text" class="form-control" id="_district" name="_district" value="{{ $district->bairro }}" disabled>
            </div>
        </div>
    </div>
@else
    <label for="state" class="form-label" style="color:red">Localidade não encontrada.</label>
@endif