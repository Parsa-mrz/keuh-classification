<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .input-label {
            background-image: url({{asset('icons/camera100w.png')}})
        }
    </style>
    <title>keuh-classification</title>
</head>

<body>

    <nav class="navbar navbar-light bg-light">
        <div>
            @if(session('alert'))
            <div class="alert alert-success" role="alert">
                <h5 class="text-secondary">{{ session('alert') }}</h5>
            </div>
            @endif
        </div>
        <a class="navbar-brand">Logo</a>
        <form class="form-inline">
            <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> -->
            <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
            <button class="btn btn-default"><span class="glyphicon glyphicon-home"></span>icon</button>
        </form>
    </nav>
    {{$content ?? ''}}
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>
    <script>
        const fileInput = document.getElementById('file-input');
        const carouselInner = document.querySelector('#image-preview .carousel-inner');

        fileInput.addEventListener('change', () => {
            // Remove any previously displayed images
            carouselInner.innerHTML = '';

            // Loop through all selected files
            for (const file of fileInput.files) {
                // Create a new image element
                const img = document.createElement('img');
                img.classList.add('d-block', 'w-100', "slider-images");
                // Set the source ofthe image to the local file
                img.src = URL.createObjectURL(file);
                // Create a new carousel item for the image
                const item = document.createElement('div');
                item.classList.add('carousel-item');
                // Add the image to the item
                item.appendChild(img);
                // Add the item to the carousel
                carouselInner.appendChild(item);
            }

            // Set the first item as active
            const firstItem = carouselInner.firstElementChild;
            if (firstItem) {
                firstItem.classList.add('active');
            }
        });
    </script>
</body>

</html>