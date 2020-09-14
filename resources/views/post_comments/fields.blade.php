<!-- Post Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('post_id', __('models/postComments.fields.post_id').':') !!}
    {!! Form::number('post_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Comment Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('comment', __('models/postComments.fields.comment').':') !!}
    {!! Form::textarea('comment', null, ['class' => 'form-control']) !!}
</div>

<!-- Parent Comment Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parent_comment_id', __('models/postComments.fields.parent_comment_id').':') !!}
    {!! Form::number('parent_comment_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Created By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_by', __('models/postComments.fields.created_by').':') !!}
    {!! Form::number('created_by', null, ['class' => 'form-control']) !!}
</div>

<!-- Updated By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('updated_by', __('models/postComments.fields.updated_by').':') !!}
    {!! Form::number('updated_by', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('postComments.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
