{!! Form::open(["route" => "products.store", "class" => "form-ajax", "id" => "form-product-store"]) !!}
<div class="form-group">
    {!! Form::label('name', trans("messages.product.name"), ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class'=>'form-control', 'placeholder' => trans("messages.product.name")] ) !!}
</div>
<div class="form-group">
    {!! Form::label('quantity', trans("messages.product.quantity"), ['class' => 'control-label']) !!}
    {!! Form::text('quantity', null, ['class'=>'form-control', 'placeholder' => trans("messages.product.quantity")] ) !!}
</div>

<div class="form-group">
    {!! Form::label('price', trans("messages.product.price"), ['class' => 'control-label']) !!}
    {!! Form::text('price', null, ['class'=>'form-control', 'placeholder' => trans("messages.product.price")] ) !!}
</div>

{!! Form::submit(trans("messages.product.create"), ['class'=>'btn btn-primary']) !!}
{!! Form::close() !!}