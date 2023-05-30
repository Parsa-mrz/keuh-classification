<x-layout>
    <x-slot name='content'>
        <h1>Cart Page</h1>
        <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="mb-3">
                <input type="file" class="form-control" name='image' id="customFile" />
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary mb-3">ذخیره</button>
            </div>
        </form>
        <div>
            @if($labels)
                <h1>Orders</h1>
                <pre>
                {{ var_dump($labels) }}
            @endif
        </div>
    </x-slot>
</x-layout>
