<x-layout>
    <x-slot name='content'>
        <div class="container-fluid">

            <div class="row" id="fist-sec">

                <div class="col-12 col-md-6 left-side custom-container">
                    <!-- <div class="background-image"></div> -->
                    <!-- <img class="img-responsive img-custom" src="https://hips.hearstapps.com/hmg-prod/images/gorditas-1-1676665006.jpg" /> -->
                    <h1 class="header-custom">Kueh Price identification system</h1>
                    <div class="card text-center details">
                        <p>
                            A new deep learning-based food image recognition web application to simplify the payment process in food details.</details>

                        </p>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('cart.create') }}">
                            <button type="button" class="btn btn-success btn-custom">Start</button>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-6 right-side">

                </div>
            </div>

        </div>
        <div>
    </x-slot>
</x-layout>