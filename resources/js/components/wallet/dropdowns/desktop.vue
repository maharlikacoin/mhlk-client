<template>
    <div class="container">
        <div class="d-lg-flex align-items-center justify-content-between">

            <div class="topbar-lg d-none d-lg-block">
                <div class="site-logo">
                    <a href="/" class="site-brand">
                        <img src="images/logo.png" alt="logo" srcset="images/logo2x.png 2x" style="width:15em;">
                    </a>
                </div><!-- .site-logo -->
            </div><!-- .topbar-lg -->

            <!-- topbar-action -->
            <div class="topbar-action d-none d-lg-block">
                <ul class="topbar-action-list">
                    <li class="topbar-action-item topbar-action-link">
                        <a :href="etherscanBaseUrl + address" target="_blank">{{ address }}</a>
                    </li><!-- .topbar-action-item -->

                    <li class="dropdown topbar-action-item topbar-action-user" @clickoutside="hideDropdown">
                        <a href="#" @click="toggleDropdown"> <img class="icon" src="/images/profile.png" alt="thumb"> </a>
                        <div class="dropdown-menu dropdown-menu-right show" v-show="showDropdown">
                            <div class="user-dropdown-head">
                                <h6 class="user-name">
                                </h6>
                            </div>
                            <div class="user-dropdown">
                                <ul class="user-dropdown-links">
                                    <li><a href="/"><i class="ti ti-home"></i>Home</a></li>
                                    <li><a :href="logout"><i class="ti ti-power-off"></i>Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </li><!-- .topbar-action-item -->
                </ul><!-- .topbar-action-list -->
            </div>
        </div><!-- .d-flex -->
    </div><!-- .container -->


</template>

<script>
	export default {
		name: "DropdownDesktop",
        props: {
		    logout: String,
            address: String
        },
        data() {
		    return {
		        etherscanBaseUrl: 'https://etherscan.io/address/',
                showDropdown: false,
            }
        },
        methods: {
            hideDropdown() {
                this.showDropdown = false;
            },
            toggleDropdown() {
		        this.showDropdown = !this.showDropdown;
		    },
            onCopy(e) {
                alert('You just copied: ' + e.text)
            },
            onError() {
                alert('Failed to copy ' + e.text)
            }
        }
	}
</script>

<style scoped>
    .user-dropdown {
        min-width: inherit;
    }
    .user-dropdown-head{
        background: #b9932e;
        padding: 1px;
    }
    .user-dropdown-head:after {
        border-bottom-color: #b9932e;
    }
    .topbar-action-item .dropdown-menu {
        min-width: 200px;
    }
    .dropdown-menu.dropdown-menu-right.show {
        transform:  translate3d(-150px, 60px, 0px);
    }
</style>
