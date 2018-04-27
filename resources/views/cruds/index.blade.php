@extends('layouts.app', [
    'title' => trans($name . '.index.title', ['name' => Auth::user()->campaign->name]),
    'description' => trans($name . '.index.description',  ['name' => Auth::user()->campaign->name]),
    'breadcrumbs' => [
        ['url' => route($name . '.index'), 'label' => trans($name . '.index.title')]
    ]
])
@inject('campaign', 'App\Services\CampaignService')


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    @can('create', $model)
                    <a href="{{ route($name . '.create') }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i> {{ trans($name . '.index.add') }}
                    </a>
                    @endcan
                    @foreach ($actions as $action)
                        @if (empty($action['policy']) || Auth::user()->can($action['policy'], $model))
                            <a href="{{ $action['route'] }}" class="btn btn-sm btn-{{ $action['class'] }}">
                                {!! $action['label'] !!}
                            </a>
                        @endif
                    @endforeach
                    <br>

                    <div class="box-tools">

                        @include('layouts.datagrid.search', ['route' => route($name . '.index')])
                    </div>
                </div>

                @include('cruds._filters', ['route' => route($name . '.index'), 'filters' => $filters, 'filterService' => $filterService, 'name' => $name])

                {!! Form::open(['url' => route($name . '.deleteMany'), 'method' => 'POST']) !!}
                <div class="box-body no-padding">
                    @include($name . '.datagrid')

                </div>
                <div class="box-footer">

                    @can('delete', $model)
                    {!! Form::submit(trans('crud.remove'), ['class' => 'btn btn-danger', 'style' => 'display:none', 'id' => 'crud-multi-delete']) !!}
                    @endcan

                    <div class="pull-right">
                        {{ $models->links() }}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
