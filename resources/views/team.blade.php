@extends('layouts.app')

@section('title') Our Team @stop
@section('banner')
    <div class="header-banner bg-theme-grad has-ovm">
        <div class="nk-banner">
            <div class="banner banner-page">
                <div class="banner-wrap">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="banner-caption cpn tc-light text-center">
                                    <div class="cpn-head">
                                        <h2 class="title ttu">Our Team</h2>
                                        <p class="text-justify">The MHLK Foundation is governed by its Board of Trustees
                                            supported by its Board of Advisors to form a group of dedicated individuals
                                            united by a common vision of a future where all of humanity has equitable
                                            access to resources needed to lead healthy, productive lives. With its wide
                                            range of knowledge and experience, hailing from backgrounds in business
                                            development, product development, mergers and acquisitions, wealth and asset
                                            management, international trade, and entrepreneurship, as well as artificial
                                            intelligence, nanotechnology, and quantum physics, Its role is to help
                                            support the foundation with expertise, and to help ensure the sustainable
                                            growth of the benefit for humanity program.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .nk-banner -->
        <div class="nk-ovm shape-a-sm"></div>
    </div>
@stop

@section('content')
    <team-index></team-index>
@stop('content')
