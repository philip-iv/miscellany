@extends('layouts.app', ['title' => trans('locations.relations.edit.title'), 'description' => trans('locations.relations.edit.description')])

@section('content')
    <div class="row">
        <div class="col-md-12 col-md-offset">
            <div class="panel panel-default">

                <div class="panel-body">
                    @include('partials.errors')

                    {!! Form::model($relation, ['method' => 'PATCH', 'route' => ['location_relation.update', $relation->id]]) !!}
                        @include('locations.relations._form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection