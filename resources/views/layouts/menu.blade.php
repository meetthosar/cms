@role('admin')
<li class="{{ Request::is('categories*') ? 'active' : '' }}">
    <a href="{{ route('categories.index') }}"><i class="fa fa-edit"></i><span>@lang('models/categories.plural')</span></a>
</li>
@endrole

<li class="{{ Request::is('posts*') ? 'active' : '' }}">
    <a href="{{ route('posts.index') }}"><i class="fa fa-edit"></i><span>@lang('models/posts.plural')</span></a>
</li>

<li class="{{ Request::is('posts*') ? 'active' : '' }}">
    <a href="/" target="_blank"><i class="fa fa-edit"></i><span>Front</span></a>
</li>


