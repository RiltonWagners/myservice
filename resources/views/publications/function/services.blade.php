@if(count($services) > 0)
    @foreach($services as $service)
    <option value="{{$service->id}}">{{$service->name}}</option>
    @endforeach

@endempty