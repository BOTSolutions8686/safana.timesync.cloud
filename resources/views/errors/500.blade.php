@extends('errors::minimal')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Server Error'))

@section('details')
    <h3>{{ _trans('project.Something went wrong on our servers.') }}</h3>
@endsection
