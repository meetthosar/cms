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

            <div class="col-sm-4">
                @if($post->image!= '' && file_exists(public_path('images/post_images/'.$post->image)))
                    <img src="{!! asset('images/post_images/'.$post->image) !!}" class="rounded" alt="{!! $post->post_title !!}" width="304" height="236">
                @else
                    <img src="{!! asset('images/post_images/no-image.png') !!}" class="rounded" alt="{!! $post->post_title !!}" width="304" height="236">
                @endif
            </div>
            <div class="col-md-8">
                <h4>{!! $post->post_title !!}</h4>
                <?php $tags = $post->postTags()->pluck('category_name', 'id')->toArray();?>
                <p>@foreach($tags as $key => $tag) <a href="/{!! $key !!}">#{!! $tag !!}</a> @endforeach</p>
                <p>{!! $post->description !!}</p>
            </div>
    </div>
</div>

{{--@auth--}}
    <br>
    <div class="container">
        @auth
        <h5>Comment as {!! auth()->user()->name; !!}</h5>
        @endauth
        <form action="{!! route('comment') !!}" class="needs-validation" novalidate method="post">
            @csrf
            <div class="form-group">
                <textarea class="form-control" name="comment" placeholder="Enter Commert" required></textarea>
                <input type="hidden" name="post_id" value="{!! $post->id !!}"/>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please enter comment.</div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <br>

    <script>
        // Disable form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Get the forms we want to add validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
{{--@else
    <div class="container">
    <a href="{!! route('login') !!}">Log In</a> / <a href="{!! route('register') !!}">Register</a> to comment
    </div>
@endauth--}}
<div class="container">
    <?php $comments = $post->postComments;?>
    @foreach($comments as $comment)
        <div class="row">
            <div class="form-group">
                <h6>comment by {!! \App\User::find($comment->created_by)->name !!}</h6>
                <p>{!! $comment->comment !!}</p>
                <p class="small">Date: {!! date('d M Y H:i', strtotime($comment->created_at)) !!}</p>
            </div>
        </div>
    @endforeach
</div>
</body>
</html>
