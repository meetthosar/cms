@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            @lang('models/postComments.singular')
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($postComment, ['route' => ['postComments.update', $postComment->id], 'method' => 'patch']) !!}

                        @include('post_comments.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
