@extends('layouts.app')

@section('content')
@csrf
<div class="container">
    <div class="row">
        <div class="col">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>product name</th>
                        <th>price</th>
                        <th>amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->order_details as $item)
                    <tr>
                        <td>{{ $item -> product_name }}</td>
                        <td>{{ $item -> price}}</td>
                        <td>{{ $item -> amount}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection