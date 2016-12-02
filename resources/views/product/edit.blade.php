<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span><span class="sr-only">Close</span>
        </button>
        <h4 class="modal-title">{{ trans("messages.product.title") }}</h4>
    </div>
    <div class="modal-body">
        {!! Form::open(["route" => ["product.update", $product->id], 'method' => 'PUT', "class" => "form-horizontal form-ajax", "id" => "form-product-edit", "novalidate" => 1]) !!}
        <div class="form-group">
            {!! Form::label('name', trans("messages.product.name"), ['class' => 'control-label']) !!}
            {!! Form::text('name', $product->name, ['class'=>'form-control', 'placeholder' => trans("messages.product.name")] ) !!}
        </div>
        <div class="form-group">
            {!! Form::label('quantity', trans("messages.product.quantity"), ['class' => 'control-label']) !!}
            {!! Form::text('quantity', $product->quantity, ['class'=>'form-control', 'placeholder' => trans("messages.product.quantity")] ) !!}
        </div>

        <div class="form-group">
            {!! Form::label('price', trans("messages.product.price"), ['class' => 'control-label']) !!}
            {!! Form::text('price', $product->price, ['class'=>'form-control', 'placeholder' => trans("messages.product.price")] ) !!}
        </div>

        {!! Form::submit(trans("messages.product.create"), ['class'=>'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">{{ trans("messages.product.update.cancel") }}</button>
        {!! Form::submit(trans("messages.product.edit"), ['class'=>'btn btn-primary', "form" => "form-product-edit"]) !!}
    </div>
</div>
