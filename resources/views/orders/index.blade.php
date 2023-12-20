@extends('scaffholding-page')
@section('title')
    {{"Cashier - All Orders"}}
@endsection
@section('content')
    <ol class="breadcrumb p-2">
        <li class="breadcrumb-item">Cashier</li>
        <li class="breadcrumb-item active">All Orders</li>
    </ol>
    @include('components.alertMessages')
{{-- TODO add view details (order_items) for each order --}}
    <div class="container-fluid">
        <table id="orderTable">
            <thead class="text-center">
            <tr>
                <th>Order ID</th>
                <th>User</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{$order->order_id}}</td>
                    <td>{{$order->user->user_name}}</td>
                    <td>{{$order->order_date}}</td>
                    <td>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#viewOrderModal{{$order->order_id}}" class="btn btn-sm btn-primary">
                    <i class="fa fa-eye text-white"></i></a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#viewOrderModal{{$order->order_id}}" class="btn btn-sm btn-warning">
                    <i class="fa fa-pencil text-white"></i></a>
                        <form action="{{ route('destroy_order', $order->order_id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this order?\nThis will delete corresponding order_items and billing history.')"><i class="fa fa-trash"></i></button>
                        </form>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a role="button" class="btn add" href="/orders_create"><i class="fa fa-fw fa-plus" ></i> Add Order</a>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready( function() {
            $('#orderTable').DataTable();
        } );
    </script>
@endsection

