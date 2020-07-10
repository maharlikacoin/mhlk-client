@extends('layouts.app')

@section('title') Privacy @stop
@section('banner')
    <div class="header-banner bg-theme-grad">
        <div class="nk-banner">
            <div class="banner banner-page">
                <div class="banner-wrap">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="banner-caption cpn tc-light text-center">
                                    <div class="cpn-head">
                                        <h2 class="title ttu">Privacy Policy</h2>
                                        <p>We value your privacy and we do what we can to minimize the exposure of personal data during the use of our interface</p>
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
    <privacy-index></privacy-index>
@stop
