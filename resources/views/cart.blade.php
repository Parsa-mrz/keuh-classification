<x-layout>
    <x-slot name='content'>
        <div class="container-fluid">
            <div class="row">

                <div class="col-12 col-md-6 left-side custom-container">
                    <div class="card text-center main-details">
                        <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data" id="form1">
                            @csrf
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <label for="file-input" class="input-label">Result</label>
                            <input type="file" name='image[]' multiple class="form-control-file" style="visibility: hidden;" id="file-input" multiple>
                            <div id="image-preview" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner"></div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#image-preview" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#image-preview" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-success btn-custom">Scan more</button>
                        <button type="submit" class="btn btn-success btn-custom">Add to cart</button>

                    </div>
                    </form>
                </div>
                <div class="col-12 col-md-6" style="background-color: #dfaa3a;">
                    <h1>Cart</h1>
                    <div style="height: 400px; overflow-y: auto;">
                        @if($labelsArray)
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">Item</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Total price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($labelsArray as $label)
                                <tr>
                                    <th scope="row">{{$label}}</th>
                                    <td>4</td>
                                    <td>0.5</td>
                                    <td>2.00</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr style="border: 1px solid #ffffff;background-color: #fff; color: green; margin-top:5px;">
                                    <th scope="col">Total</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col">234</th>
                                </tr>
                            </tfoot>
                        </table>
                        @endif

                        @if(!$labelsArray)
                        <div>
                            <h2>Cart is empty</h2>
                        </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </x-slot>
</x-layout>