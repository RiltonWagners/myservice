@if(count($services) > 0)
<select id="id_service" name="id_service" class="form-select">
    <option value="" selected>Selecione o serviço</option>

    @foreach($services as $service)
    <option value="{{$service->id}}">{{$service->name}}</option>
    @endforeach
    
</select>

@endempty