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
                        <th>Check Out</th>
                    </tr>
                </thead>
                <tbody>
                    @if($order)
                    @foreach ($order->order_details as $item)
                    <tr>
                        <td>{{ $item -> product_name }}</td>
                        <td>{{ $item -> price}}</td>
                        <td>{{ $item -> amount}}</td>
                        <td>
                            <div class="row text-center">
                                <div class="col-6">
                                    <form action="{{ route('orders.update', $order->id) }} " method="POST">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" value="decrease" name="value" />
                                        <input type="hidden" value=" {{ $item -> product_id }}" name="product_id" />
                                        <button class="btn btn-outline-danger" type="submit"> - </button>
                                    </form>
                                </div>
                                <div class="col-6">
                                    <form action="{{ route('orders.update', $order->id) }} " method="POST">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" value="increase" name="value" />
                                        <input type="hidden" value=" {{ $item -> product_id }}" name="product_id" />
                                        <button class="btn btn-outline-success" type="submit"> + </button>
                                    </form>
                                </div>
                            </div>

                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td>{{ $order -> total }}</td>
                        <td class="text-center">

                            <form action="{{route('orders.update', $order->id)}}" method="POST">
                                @csrf
                                @method('put')
                                <input type="hidden" name="value" value="checkout">
                                <button class="btn btn-outline-success" type="submit">Checkout</button>

                            </form>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection