<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redakte</title>
</head>
<body>
    <form action="{{route('admin.sale.update',['sale_id'=>$sale->id]) }}" method="POST">
        @csrf 
        <label>Musteri</label><br>
        <select name="customer_id">
            @foreach($customers as $customer)
              <option value="{{$customer->id}}" {{$sale->customer_id == $customer->id ? 'selected' : ''}}> {{$customer->name}}</option>
            @endforeach
        </select>
        <br><br>
        <label>Xidmet</label><br>
        <select name="service_id">
            @foreach($services as $service)
               <option value="{{$service->id}}" {{$sale->service_id == $service->id ? 'selected' : ''}}>{{$service->title}}</option>
            @endforeach
        </select>
        <br>
        <label>Qiymet</label><br>
        <input type="number" step="0.01" name="price" value="{{old('price',$sale->price)}}">
        <br><br>
        <label >Tarix</label><br>
        <input type="date" name = "sale_date" value = "{{old('sale_date',$sale->sale_date)}}"><br><br>
        <button type="submit">Yenile</button>
    </form>
      @if($errors->any())
                        <div class="alert alert-danger mt-4">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
</body>
</html>