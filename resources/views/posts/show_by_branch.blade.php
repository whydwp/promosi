<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promosi Resto</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        .carousel-item {
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
            width: 100%;
        }

        /* Custom styles for carousel controls */
        .carousel-control-next,
        .carousel-control-prev {
            width: 50px;
            height: 50px;
            border: none;
            transition: all 0.3s ease;
            top: calc(50% - 25px);
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
           
            border-radius: 50%; /* Added border-radius */
            color: #fff; /* Added color */
        }

        /* Additional styles for icon container */
        .carousel-control-next-icon-container,
        .carousel-control-prev-icon-container {
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: transparent;
            margin-top: -20px
        }
    </style>
</head>

<body>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach ($posts as $postIndex => $post)
            @foreach (json_decode($post->image) as $imageIndex => $image)
            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $postIndex * count(json_decode($post->image)) + $imageIndex }}" class="{{ $postIndex === 0 && $imageIndex === 0 ? 'active' : '' }}"></li>
            @endforeach
            @endforeach
        </ol>
        <div class="carousel-inner">
            @foreach ($posts as $post)
            @foreach (json_decode($post->image) as $imageIndex => $image)
            <div class="carousel-item {{ $loop->first && $loop->parent->first ? 'active' : '' }}">
                <img src="https://webpromosi.miegacoan.co.id/public/images/{{ $image }}" class="d-block w-100" style="object-fit: fill; height: 800px;">
            </div>
            @endforeach
            @endforeach
        </div>

        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <div class="carousel-control-prev-icon-container">
                <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
            </div>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <div class="carousel-control-next-icon-container">
                <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
            </div>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
