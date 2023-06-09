<!DOCTYPE html>
<html>
<head>
    <title>Video List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Videos</h2>
        </div>
        <div class="card-body">
            @foreach($videos as $video)
                <div class="row">
                    <div class="col-md-6">
                        <h4>{{$video->title}}</h4>
                        <p>{{$video->description}}</p>
                    </div>
                    <div class="col-md-6">
                        <iframe width="100%" height="auto" src="{{$video->src}}" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
</body>
</html>
