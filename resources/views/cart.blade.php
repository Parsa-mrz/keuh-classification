<x-layout>
    <x-slot name='content'>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-5 left-side custom-container">
                    <div class="card text-center main-details">
                        <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data" id="form1">
                            @csrf
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type='file' id="imgInp" name='image[]' multiple class="form-control-file" style="background-color: green; border-radius: 5px; padding: 5px;" />
                            <br>
                            <img id="blah" src="#" alt=" Your image" style="height: 20rem; width: 15rem;" />
                            <div class="text-center">
                                <button type="button" class="btn btn-success btn-custom">Scan more</button>
                                <button type="submit" class="btn btn-success btn-custom">Add to cart</button>

                            </div>
                        </form>
                    </div>

                </div>
                <div class="col-12 col-md-7" style="background-color: rgb(223, 170, 58);">
                    <h1>Cart</h1>
                    @if(!empty($labelsArray[0]))
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Item</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Total price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($labelsArray as $label)
                            <tr>
                                <th scope="row">1</th>
                                <td>{{$label}}</td>
                                <td>4</td>
                                <td>0.5</td>
                                <td>2.00</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr style="border: 1px solid black;">
                                <th scope="col">Total</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col">234</th>
                            </tr>
                        </tfoot>
                    </table>
                    @endif

                    @if(empty($labelsArray[0]))
                    <div>
                        <h3>The Cart is empty</h3>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </x-slot>
</x-layout>