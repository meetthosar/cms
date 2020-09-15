<!DOCTYPE html>
<html lang="en">
<head>
    <title>CMS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
@include('nav')

<div class="container">
    <div class="row">
        @foreach($posts as $post)
        <div class="col-sm-4">
            <a href="{!! route('single',[$post->id]) !!}">
            @if($post->image!= '' && file_exists(public_path('images/post_images/'.$post->image)))
            <img src="{!! asset('images/post_images/'.$post->image) !!}" class="rounded" alt="{!! $post->post_title !!}" width="300" height="300">
            @else
                <img src="{!! asset('images/post_images/no-image.png') !!}" class="rounded" alt="{!! $post->post_title !!}" width="304" height="236">
            @endif
            </a>
            <h4>{!! $post->post_title !!}</h4>
                <?php $tags = $post->postTags()->pluck('category_name', 'id')->toArray();?>
            <p>@foreach($tags as $key => $tag) <a href="{!! route('tag', [$key]) !!}">#{!! $tag !!}</a> @endforeach</p>
        </div>
        @endforeach

    </div>
</div>

</body>
</html>

