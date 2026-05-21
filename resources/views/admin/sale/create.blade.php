<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yeni Satış</title>
</head>
<body>
    <h3>Yeni satis elave et</h3>
    <a href="{{route('admin.sale.index')}}">Geri qayit</a>

    <form action="{{route('admin.sale.store')}}" method="POST">
        @csrf
       <div>
         <label for="customer_id">Musteri secin</label><br>
        <select name="customer_id" id="customer_id">
            <option value="">--Musteri secin--</option>
            @foreach($customers as $customer)
            <option value="{{$customer->id}}">{{$customer->name}}</option>
            @endforeach
        </select>
       </div>
       <br>

       <div>
        <label for="service_id">Xidmeti secin</label><br>
        <select name="service_id" id="service_id">
            <option value="">--Xidmeti secin--</option>
            @foreach($services as $service)
            <option value="{{$service->id}}">{{$service->title}}</option>
            @endforeach
            </select>
       </div>
       <br>
       <div>
          <label for="price">Satis qiymeti</label><br>
          <input type="number" step="0.01" name="price" id="price" value="{{old('price')}}">
       </div>
       <br>
       <div>
        <label for="sale_date">Satis tarixi</label><br>
         <input type="date" name="sale_date" id="sale_date" value="{{old('sale_date')}}">
       </div>
       <br>
       <div>
        <label for="note">Qeyd</label><br>
        <textarea name="note" id="note" cols="30" rows="5">{{old('note')}}</textarea>
       </div>
       <br>
       <button type="submit">Satisi tamamla</button>
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