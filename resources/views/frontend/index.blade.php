@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-home"></i> @lang('navs.general.home')
                </div>
                <div class="card-body">
                   <h1 align='center'>MFMRD FILE MANAGER </h1>
                    <img src='img/logo.png' style="width:1050px;height:400px;" class="center" />
                </div>
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->       
@endsection
