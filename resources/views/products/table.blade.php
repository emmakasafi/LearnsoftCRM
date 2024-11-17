<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="products-table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity Available</th>
                    <th>Lead</th> <!-- Display related Lead's full name -->
                    <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->quantity_available }}</td>
                        <td>
                            @if($product->lead)
                                {{ $product->lead->full_name ?? 'N/A' }} <!-- Display full_name of the related lead -->
                            @else
                                N/A
                            @endif
                        </td>
                        <td style="width: 120px">
                            {!! Form::open(['route' => ['products.destroy', $product->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                <a href="{{ route('products.show', [$product->id]) }}"
                                   class='btn btn-default btn-xs'>
                                    <i class="far fa-eye"></i>
                                </a>
                                <a href="{{ route('products.edit', [$product->id]) }}"
                                   class='btn btn-default btn-xs'>
                                    <i class="far fa-edit"></i>
                                </a>
                                {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                            </div>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $products])
        </div>
    </div>
</div>
