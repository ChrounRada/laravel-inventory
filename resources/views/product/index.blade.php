@extends('layout.base')
@section('content')

<div class="container-fluid">

    <div class="row">
        <div class="col-md-6 col-sm-6">
            <h1 class="h3 mb-2 text-gray-800">Tables</h1>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="float-md-right float-sm-left">
                <a href="#" class="btn btn-secondary btn-icon-split mb-2  mr-1">
                    <span class="text">Name</span>
                </a>
                <a href="#" class="btn btn-secondary btn-icon-split mb-2 mr-1">
                    <span class="text">Qty</span>
                </a>
                <button type="button" data-toggle="modal" data-target="#form-create" data-whatever="@mdo"
                    class="btn btn-primary btn-icon-split mb-2 mr-1">
                    <span class="text">Create</span>
                </button>

                @include('product.create')

            </div>
        </div>
    </div>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th class="text-center"width="120">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{!! $loop->index+1 !!}</td>
                                <td>NULL</td>
                                <td>{!! $product->name !!}</td>
                                <td>{!! $product->category->name !!}</td>
                                <td>{!! $product->description !!}</td>
                                <td>{!! $product->quantity !!}</td>
                                <td class="d-flex justify-content-between" width="120">
                                    <a type="button" data-toggle="modal" data-target="#form-edit" data-whatever="@mdo" data-product={!! $product->id !!} class="btn btn-success btn-circle btn-edit">
                                        <i class="fas fa-pen"></i>
                                    </a>

                                    @include('product.edit')
    
                                    <a href="{!! route("product.destroy",$product->id) !!}" class="btn btn-danger btn-circle btn-delete">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- @if (isset($products))
        <div class="row">
            <div class="col-md-12 float-right">
                <div class="d-flex justify-content-start">{{ $products->links() }}</div>
            </div>
        </div>
    @endif --}}

</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){

        $(".btn-delete").click(function(e){
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                }
            })
        });

        //ajax for edit
        $(".btn-edit").click(function (event) {
            event.preventDefault();
            var product = $(this).attr("data-product");
            var url = "product/update/"+product;
            $.ajax({
                type: "GET",
                url: "product/edit/"+product,
                success: function (data) {
                    $(".dynamic").html(data.html);
                    $("#form-update").attr("action", url);
                },
            });
        });
    });
</script>
@endsection