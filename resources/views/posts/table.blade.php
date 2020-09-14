<div class="table-responsive">
    <table class="table" id="posts-table">
        <thead>
            <tr>

        <th>@lang('models/posts.fields.post_title')</th>
        <th>@lang('models/posts.fields.description')</th>
        <th>@lang('models/posts.fields.image')</th>

                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>

            <td>{{ $post->post_title }}</td>
            <td>{{ $post->description }}</td>
            <td>@if($post->image != '') <img src="{!! asset('images/post_images/'.$post->image ) !!}" width="100" height="100"> @else No Image @endif</td>

                <td>
                    {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('posts.show', [$post->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('posts.edit', [$post->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
