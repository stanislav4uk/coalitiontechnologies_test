@extends('layouts.app')

@section('content')
    @include('product.form')
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Product name</th>
            <th>Quantity in stock</th>
            <th>Price per item</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($products as $product)
            <tr>
                <th scope="row">{{ $product->id }}</th>
                <td>{{ $product->name }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    <a href="{{ route('products.edit', ["id" => $product->id]) }}" class="btn btn-info btn-circle" data-type="modal"><i class="fa fa-pencil"></i></a>
                </td>
            </tr>
        @empty
            <tr>
                <td><p>No products</p></td>
            </tr>
        @endforelse

        </tbody>
    </table>
@endsection