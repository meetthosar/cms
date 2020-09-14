<!-- Post Title Field -->
<div class="form-group">
    {!! Form::label('post_title', __('models/posts.fields.post_title').':') !!}
    <p>{{ $post->post_title }}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', __('models/posts.fields.description').':') !!}
    <p>{{ $post->description }}</p>
</div>

<!-- Image Field -->
<div class="form-group">
    {!! Form::label('image', __('models/posts.fields.image').':') !!}
    <p>@if($post->image != '') <img src="{!! asset('images/post_images/'.$post->image ) !!}" width="100" height="100"> @else No Image @endif</p>
</div>

<!-- Tags Field -->
<div class="form-group">
    {!! Form::label('tags', __('models/posts.fields.tags').':') !!}
    <p>#{{ implode(',#',$post->postTags()->pluck('category_name', 'id')->toArray()) }}</p>
</div>

