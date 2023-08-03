@if(count($cities))
    <option value="" selected>Selecione a cidade</option>
@else
    <option value="" selected>Selecione</option>
@endempty

@foreach($cities as $city)
    <option value="{{$city->id}}">{{$city->name}}</option>
@endforeach