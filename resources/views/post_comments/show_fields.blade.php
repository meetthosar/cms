<!-- Post Id Field -->
<div class="form-group">
    {!! Form::label('post_id', __('models/postComments.fields.post_id').':') !!}
    <p>{{ $postComment->post_id }}</p>
</div>

<!-- Comment Field -->
<div class="form-group">
    {!! Form::label('comment', __('models/postComments.fields.comment').':') !!}
    <p>{{ $postComment->comment }}</p>
</div>

<!-- Parent Comment Id Field -->
<div class="form-group">
    {!! Form::label('parent_comment_id', __('models/postComments.fields.parent_comment_id').':') !!}
    <p>{{ $postComment->parent_comment_id }}</p>
</div>

<!-- Created By Field -->
<div class="form-group">
    {!! Form::label('created_by', __('models/postComments.fields.created_by').':') !!}
    <p>{{ $postComment->created_by }}</p>
</div>

<!-- Updated By Field -->
<div class="form-group">
    {!! Form::label('updated_by', __('models/postComments.fields.updated_by').':') !!}
    <p>{{ $postComment->updated_by }}</p>
</div>

