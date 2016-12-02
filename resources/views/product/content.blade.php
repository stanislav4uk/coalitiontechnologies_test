@include('product.form')
<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>Product name</th>
        <th>Quantity in stock</th>
        <th>Price per item</th>
        <th>Date</th>
        <th>Total</th>
        <th>Edit</th>
    </tr>
    </thead>
    <tbody>
    <?php $total = 0 ?>
    @forelse ($products as $product)
        <tr>
            <th scope="row">{{ $product->id }}</th>
            <td>{{ $product->name }}</td>
            <td>{{ $product->quantity }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->created_at }}</td>
            <?php $total += ($product->quantity * $product->price) ?>
            <td>{{ $product->quantity * $product->price }}</td>
            <td>
                <a href="{{ route('products.edit', ["id" => $product->id]) }}" class="btn btn-info btn-circle" data-type="modal"><i class="fa fa-pencil"></i></a>
            </td>
        </tr>
    @empty
        <tr>
            <td><p>No products</p></td>
        </tr>
    @endforelse
    @if ($total)
        <tr>
            <td colspan="5" class="text-right"></td>
            <td>{{ $total }}</td>
            <td></td>
        </tr>
    @endif
    </tbody>
</table>