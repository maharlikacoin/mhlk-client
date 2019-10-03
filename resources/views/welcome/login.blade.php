<!-- Modal @s -->
<div class="modal fade" id="login-popup">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
            <div class="ath-container m-0">
                <div class="ath-body">
                    <h5 class="ath-heading title">Login <small class="tc-default">with your Maharlika Account</small></h5>
                    <form action="{{ route('wallet.login') }}" method="POST">
                        @csrf
                        <div class="field-item">
                            <div class="field-wrap">
                                <input type="text" class="input-bordered" name="address" placeholder="Your wallet address (public key)" required>
                            </div>
                        </div>
                        <button class="btn btn-grad w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div><!-- .modal @e -->
