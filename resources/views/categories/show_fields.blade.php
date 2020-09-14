<!-- Category Name Field -->
<div class="form-group">
    {!! Form::label('category_name', __('models/categories.fields.category_name').':') !!}
    <p>{{ $category->category_name }}</p>
</div>

<!-- Created By Field -->
<div class="form-group">
    {!! Form::label('created_by', __('models/categories.fields.created_by').':') !!}
    <p>{{ $category->created_by }}</p>
</div>

<!-- Updated By Field -->
<div class="form-group">
    {!! Form::label('updated_by', __('models/categories.fields.updated_by').':') !!}
    <p>{{ $category->updated_by }}</p>
</div>

