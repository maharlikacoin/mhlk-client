<template>
    <div>
        <b-container fluid>
            <!-- Main table element -->
            <b-table id="transactionsTable"
                     responsive
                     :busy="isBusy"
                     show-empty
                     stacked="md"
                     :items="items"
                     :fields="fields"
                     :current-page="currentPage"
                     :per-page="perPage"
                     :filter="filter"
                     :sort-by.sync="sortBy"
                     :sort-desc.sync="sortDesc"
                     :sort-direction="sortDirection"
                     @filtered="onFiltered">
              <template slot="hash" slot-scope="row">
                    <a :href="transactionBaseUrl+row.value" target="_blank">{{ row.value | trimAddress | upperAddress }}</a>
                </template>
                <template slot="timestamp" slot-scope="row">{{ row.value | moment }}</template>
                <template slot="from" slot-scope="row">
                    <a :href="addressBaseUrl+row.value" target="_blank">{{ row.value | trimAddress | upperAddress }}</a>
                </template>
                <template slot="to" slot-scope="row">
                    <a :href="addressBaseUrl+row.value" target="_blank">{{ row.value | trimAddress | upperAddress }}</a>
                </template>
                <template slot="value" slot-scope="row">
                    {{ row.value/100 | numberFormat('0,000.00') }}
                </template>
            </b-table>

            <!--<b-row>-->
                <!--<b-col md="1" class="my-1">-->
                    <!--<b-pagination-->
                        <!--:per-page="perPage"-->
                        <!--:total-rows="totalRows"-->
                        <!--v-model="currentPage" class="my-0"-->
                    <!--/>-->
                <!--</b-col>-->
            <!--</b-row>-->

            <!-- Info modal -->
            <b-modal id="modal" @hide="resetModal" :title="modal.title" ok-only >
                Transaction Information
            </b-modal>
        </b-container>
    </div>
</template>

<script>
    import bContainer from 'bootstrap-vue/es/components/layout/container';
    import bRow from 'bootstrap-vue/es/components/layout/row';
    import bCol from 'bootstrap-vue/es/components/layout/col';
    import bFormGroup from 'bootstrap-vue/es/components/form-group/form-group';
    import bFormInput from 'bootstrap-vue/es/components/form-input/form-input';
    import bFormSelect from 'bootstrap-vue/es/components/form-select/form-select';
    import bInputGroup from 'bootstrap-vue/es/components/input-group/input-group';
    import bInputGroupAppend from 'bootstrap-vue/es/components/input-group/input-group-append';
    import bTable from 'bootstrap-vue/es/components/table/table';
    import bPagination from 'bootstrap-vue/es/components/pagination/pagination';
    import bButton from 'bootstrap-vue/es/components/button/button';
    import bCard from 'bootstrap-vue/es/components/card/card';
    import bModal from 'bootstrap-vue/es/components/modal/modal';

    export default {
        name: "Transactions",
        props: {
            address: String
        },
        components: {
            bContainer,
            bRow,
            bCol,
            bFormGroup,
            bFormInput,
            bFormSelect,
            bInputGroup,
            bInputGroupAppend,
            bTable,
            bPagination,
            bButton,
            bCard,
            bModal,
        },
        data () {
            return {
                apiBaseUrl: 'https://api.etherscan.io/api?',
                module: 'account',
                action: 'tokentx', //txlist
                apikey: 'GEPXM3N11F476EMB8FCXG2XVK89Y5PKMFK',
                contractAddress: '0xe3d0a162fcc5c02c9448274d7c58e18e1811385f',
                transactionBaseUrl: 'https://etherscan.io/tx/',
                addressBaseUrl: 'https://etherscan.io/address/',
                isBusy: false,
                totalRows: 0,
                pageOptions: [ 5, 10, 15 ],
                items: [],
                fields: [
                    { key: 'hash', label: 'Reference', sortable: true, sortDirection: 'desc' },
                    { key: 'timeStamp', label: 'Date', sortable: true, sortDirection: 'desc'  },
                    { key: 'from', label: 'From', sortable: true, sortDirection: 'desc'  },
                    { key: 'to', label: 'To', sortable: true, sortDirection: 'desc'  },
                    { key: 'value', label: 'Amount', sortable: true, sortDirection: 'desc'  },
                ],
                currentPage: 1,
                perPage: 7,
                filter: null,
                sortBy: 'created_at',
                sortDesc: true,
                sortDirection: 'desc',
                modal: {
                    _hash: '',
                    _timestamp: '',
                    _from: '',
                    _to: '',
                    _value: '',
                },
            }
        },
        methods: {
            info (row, index, button) {
                let item = row.item;
                this.modal._hash = item.hash;
                // row.toggleDetails;
                this.$root.$emit('bv::show::modal', 'modal', button);
            },
            resetModal () {
                for ( let field in this.modal) {
                    if (this.modal.hasOwnProperty(field) ) {
                        this.modal[field] = '';
                    }
                }
            },
            onFiltered (filteredItems) {
                // Trigger pagination to update the number of buttons/pages due to filtering
                this.totalRows = filteredItems.length;
                this.currentPage = 1;
            },
            getTransactions() {
                delete axios.defaults.headers.common["X-Requested-With"];
                let url = `${this.apiBaseUrl}module=${this.module}&action=${this.action}&contractaddress=${this.contractAddress}&address=${this.address}&startblock=0&endblock=99999999&page=1&offset=10&sort=desc&apikey=${this.apikey}`;

                this.isBusy = true;
                // etherscan.account.tokentx(this.address, this.contractAddress, 1, 'latest',2, 2, 'desc')
                axios.get(url)
                    .then(response => {
                        let data = response.data.result;
                        this.totalRows = data.length;

                        console.log(data);
                        this.items = data.map( ({hash, timeStamp, to, from, value}) => {
                            return {
                                hash: hash,
                                timeStamp: timeStamp,
                                to: to,
                                from: from,
                                value: value
                            }
                        })
                    })
                    .catch(error => {
                        console.log(error);
                        this.totalRows = 0;
                        this.items = [];
                    })
                    .finally(() => {
                        this.isBusy = false;
                    });
            }
        },
        mounted() {
            this.getTransactions();
        },
        events: {
            'b-table-refresh-transactions' () {
                this.getTransactions();
            }
        }
    }
</script>

<style scoped>

</style>
