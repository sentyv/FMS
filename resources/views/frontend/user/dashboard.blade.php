@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.frontend.dashboard') )

@section('content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>
                        <i class="fas fa-tachometer-alt"></i> @lang('navs.frontend.dashboard')
                    </strong>
                </div><!--card-header-->

                <div class="card-body">
                    <div class="row">
                        <div class="col col-sm-4 order-1 order-sm-2  mb-4">
                            <div class="card mb-4 bg-light">
                                <img class="card-img-top" src="{{ $logged_in_user->picture }}" alt="Profile Picture">

                                <div class="card-body">
                                    <h4 class="card-title">
                                        {{ $logged_in_user->name }}<br/>
                                    </h4>

                                    <p class="card-text">
                                        <small>
                                            <i class="fas fa-envelope"></i> {{ $logged_in_user->email }}<br/>
                                            <i class="fas fa-calendar-check"></i> @lang('strings.frontend.general.joined') {{ timezone()->convertToLocal($logged_in_user->created_at, 'F jS, Y') }}
                                        </small>
                                    </p>

                                    <p class="card-text">

                                        <a href="{{ route('frontend.user.account')}}" class="btn btn-info btn-sm mb-1">
                                            <i class="fas fa-user-circle"></i> @lang('navs.frontend.user.account')
                                        </a>

                                        @can('view backend')
                                            &nbsp;<a href="{{ route('admin.dashboard')}}" class="btn btn-danger btn-sm mb-1">
                                                <i class="fas fa-user-secret"></i> @lang('navs.frontend.user.administration')
                                            </a>
                                        @endcan
                                    </p>
                                </div>
                            </div>

                            <div class="card mb-4">
                                <div class="card-header">MFMRD-IMSv1</div>
                                <div class="card-body">
                                    <h4 class="card-title">Information Management System</h4>
                                    <p class="card-text">Modules to support MFMRD.</p>
                                </div>
                            </div><!--card-->
                        </div><!--col-md-4-->

                        <div class="col-md-8 order-2 order-sm-1">

                            <p class="card-text">Welcome to the {{ app_name() }} Dashboard page. Navigate to any module by clicking any of the links below.</p>

                            <div class="row">

                                @can('hrs.view')
                                    <div class="col-4">
                                        <div class="card border-info mb-4">
                                            <div class="card-header">
                                                Human Resources Sys
                                            </div><!--card-header-->
                                            <div class="card-body">
                                                <a href="/hrs" class="btn btn-primary btn-block"><i class="fas fa-eye"></i> <strong>HRS</strong></a>
                                            </div><!--card-body-->
                                        </div><!--card-->
                                    </div><!--col-6-->
                                @endcan   

                                @can('mrs.view')
                                    <div class="col-4">
                                        <div class="card border-info mb-4">
                                            <div class="card-header">
                                                Mail Record System
                                            </div><!--card-header-->
                                            <div class="card-body">
                                                <a href="/mrs" class="btn btn-primary btn-block"><i class="fas fa-eye"></i> <strong>MRS</strong></a>
                                            </div><!--card-body-->
                                        </div><!--card-->
                                    </div><!--col-6-->
                                @endcan

                                @can('pms.view')

                                    <div class="col-4">
                                        <div class="card border-info mb-4">
                                            <div class="card-header">
                                                Project Management
                                            </div><!--card-header-->
                                            <div class="card-body">
                                                <a href="/asm" class="btn btn-primary btn-block"><i class="fas fa-eye"></i> <strong>PMS</strong></a>
                                            </div><!--card-body-->
                                        </div><!--card-->
                                    </div><!--col-6-->
                                @endcan
                                

                              

                            </div><!--row-->

                        </div><!--col-md-8-->



                    </div><!-- row -->
                </div> <!-- card-body -->
            </div><!-- card -->
        </div><!-- row -->
    </div><!-- row -->
@endsection
