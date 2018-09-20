@extends('layouts.app', [
    'title' => trans('settings.layout.title'),
    'description' => trans('settings.layout.description'),
    'breadcrumbs' => false
])

@section('content')
    @include('partials.errors')
    <div class="row">
        <div class="col-md-2">
            @include('settings.menu', ['active' => 'layout'])
        </div>
        <div class="col-md-4">
            {!! Form::model(auth()->user(), ['method' => 'PATCH', 'route' => ['settings.layout']]) !!}
            <div class="box box-solid">
                <div class="box-body">
                    <h2 class="page-header with-border">
                        {{ trans('settings.layout.title') }}
                    </h2>

                    <div class="form-group">
                        <label>{{ trans('profiles.fields.theme') }}</label>
                        {!! Form::select('theme', [
                            '' => trans('profiles.theme.themes.default'),
                            'dark' => trans('profiles.theme.themes.dark'),
                            'future' => trans('profiles.theme.themes.future'),
                            'midnight' => trans('profiles.theme.themes.midnight')
                        ], null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        <label>{{ trans('profiles.settings.fields.pagination') }}</label>
                        {!! Form::select('default_pagination', [
                            15 => 15,
                            25 => 25,
                            45 => 45
                        ], null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        <label>{{ trans('profiles.settings.fields.date_format') }}</label>
                        {!! Form::select('date_format', [
                            'Y-m-d' => 'Y-m-d',
                            'd.m.Y' => 'd.m.Y',
                            'd-m-y' => 'd-m-y',
                            'm/d/Y' => 'm/d/Y'

                        ], null, ['class' => 'form-control']) !!}
                    </div>
                    <button class="btn btn-primary">
                        {{ trans('crud.save') }}
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection