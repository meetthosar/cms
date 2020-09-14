<div class="table-responsive">
    <table class="table" id="postComments-table">
        <thead>
            <tr>

        <th>@lang('models/postComments.fields.comment')</th>
        <th>@lang('models/postComments.fields.created_by')</th>

                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
        @foreach($postComments as $postComment)
            <tr>

            <td>{{ $postComment->comment }}</td>
            <td>{{  \App\User::where('id',$postComment->created_by )->first()->name}}</td>

                <td>
                    {!! Form::open(['route' => ['postComments.destroy', $postComment->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('postComments.show', [$postComment->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('postComments.edit', [$postComment->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
