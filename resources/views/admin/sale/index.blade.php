<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Satislar</title>
</head>
<body>
    <h1>Satis siyahisi</h1>
    <a href="{{route('admin.sale.create')}}">Yeni satis elave et</a> <br><br>
    <table border="1" style="border-collapse:collapse; width:100%" >
        <thead>
            <tr>
                <th>ID</th>
                <th>Musteri Siyahisi</th>
                <th>Xidmet</th>
                <th>Qiymet(AZN)</th>
                <th>Tarix</th>
                <th>Qeyd</th>
                <th>Emaliyyatlar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sales as $sale)
              <tr>
                <td>{{$sale->id}}</td>
                <td>{{$sale->customer->name}}</td>
                <td>{{$sale->service->title}}</td>
                <td>{{$sale->price}}</td>
                <td>{{$sale->sale_date}}</td>
                <td>{{$sale->note}}</td>
                <td>
                    <a href="{{route('admin.sale.edit',$sale->id)}}">Redakte et</a>
                    <a href="{{route('admin.sale.delete',$sale->id)}}">Sil</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>