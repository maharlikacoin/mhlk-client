<div class="user-wraper flex-grow-1">
    <div class="container">
        <div class="d-flex">
            <div class="user-sidebar">
                <user-sidebar address="{{ session('authAddress') }}"></user-sidebar><!-- .user-box -->
                <div class="d-lg-none">
                    <div class="user-sidebar-sap"></div>
                    <div class="gaps-1x"></div>
                    <ul class="topbar-action-list">
                        <li class="topbar-action-item topbar-action-link">
                            <a href="#"><em class="ti ti-home"></em> Go to main site</a>
                        </li><!-- .topbar-action-item -->
                        <li class="dropup topbar-action-item topbar-action-language">
                            <a href="#" data-toggle="dropdown" aria-haspopup="true"> EN <em class="ti ti-angle-up"></em>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#">FR</a></li>
                                <li><a href="#">JY</a></li>
                                <li><a href="#">CH</a></li>
                            </ul>
                        </li><!-- .topbar-action-item -->
                    </ul><!-- .topbar-action-list -->
                </div>
            </div><!-- .user-sidebar -->

            <div class="user-content">
                <div class="user-panel">
                    <div class="row">
                        <maharlika-tile address="{{ session('authAddress') }}"></maharlika-tile>
                        <ether-tile address="{{ session('authAddress') }}"></ether-tile>
                    </div><!-- .row -->
                    <transactions address="{{ session('authAddress') }}"></transactions>

                </div><!-- .user-panel -->
            </div><!-- .user-content -->
        </div><!-- .d-flex -->
    </div><!-- .container -->
</div>
<!-- UserWraper End -->
