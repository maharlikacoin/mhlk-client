<template>
    <div class="user-box d-none d-lg-block" style="padding:30px;">
        <div class="user-image">
            <img src="/images/eth-qr.png" alt="adddress">
        </div>
        <h6 class="user-name">{{ address | trimAddress | upperAddress }}</h6>
        <ul class="btn-grp guttar-10px">
            <li><a href="#" class="btn btn-grad">TRANSFER</a></li>
        </ul>
    </div>
</template>

<script>
	export default {
		name: "UserSidebar",
        props: {
		    address: String
        },
        beforeCreate() {

        }
	}
</script>
