@extends('layouts.app')

@section('title') Terms and Conditions @stop
@section('banner')
    <div class="header-banner bg-theme-grad">
        <div class="nk-banner">
            <div class="banner banner-page">
                <div class="banner-wrap">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xl-6 col-lg-9">
                                <div class="banner-caption cpn tc-light text-center">
                                    <div class="cpn-head">
                                        <h2 class="title ttu">Terms and Conditions</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .nk-banner -->
    </div>
    <div class="nk-ovm shape-a-sm"></div>
@stop
@section('content')
    <terms-index></terms-index>
@stop
