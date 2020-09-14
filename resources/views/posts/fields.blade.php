<!-- Category Id Field -->
{{--{!! dd(\App\Models\PostTag::where('post_id', $post->id)->pluck('id')) !!}--}}
<div class="form-group col-sm-6">
    {!! Form::label('category_id', __('models/posts.fields.category_id').':') !!}
    {!! Form::select('category_id[]',['other' => "Other"] + \App\Models\Category::all()->pluck('category_name','id')->toArray() , isset($post)? \App\Models\PostTag::where('post_id', $post->id)->pluck('category_id'):null, ['class' => 'form-control','id' => 'category_id', 'multiple' => 'true']) !!}
</div>

<div class="form-group col-sm-6" id="otherTag" style="display: {!!  old('category')? old('category') : 'none' !!};">
    {!! Form::label('category', __('models/posts.fields.other_tag').':') !!}
    {!! Form::text('category', old('category')? old('category') :null, ['class' => 'form-control']) !!}
</div>

<!-- Post Title Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('post_title', __('models/posts.fields.post_title').':') !!}
    {!! Form::text('post_title', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', __('models/posts.fields.description').':') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('image', __('models/posts.fields.image').':') !!}
    {!! Form::file('image', null, ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('posts.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#category_id').change(function () {
                var cat = $(this).val();console.log($.inArray('other', cat))
                if($.inArray('other', cat) != -1)
                    $('#otherTag').show();
                else
                    $('#otherTag').hide();
            })
        })
    </script>
@endpush
