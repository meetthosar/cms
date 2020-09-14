@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            @lang('models/posts.singular')
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('posts.show_fields')
                    <a href="{{ route('posts.index') }}" class="btn btn-default">
                        @lang('crud.back')
                    </a>
                </div>
            </div>
        </div>
    </div>
    <section class="content-header">
        <h1>
            @lang('models/posts.fields.comments')
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                @include('post_comments.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection
