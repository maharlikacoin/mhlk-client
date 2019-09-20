<template>
    <div>
        <b-table responsive
                 :items="items"
                 :fields="fields">
            <!-- We are using utility class `text-nowrap` to help illustrate horizontal scrolling -->
            <!-- value -->
            <template slot="value" slot-scope="row">
                <div v-html="$options.filters.reduceSizeDecimal(row.value/100)"></div>
            </template>
            <!-- from address -->
            <template slot="from" slot-scope="row">
                <a :href="addressBaseUrl+row.value" target="_blank" v-if="address.toLowerCase() !== (row.value).toLowerCase()">
                    {{ row.value | trimAddress }}
                </a>
                <div v-else>{{ row.value | trimAddress }}</div>
            </template>
            <!-- to address -->
            <template slot="to" slot-scope="row">
                <a :href="addressBaseUrl+row.value" target="_blank" v-if="address.toLowerCase() !== (row.value).toLowerCase()">
                    {{ row.value | trimAddress  }}
                </a>
                <div v-else>{{ row.value | trimAddress }}</div>
            </template>

            <!-- date -->
            <template slot="timeStamp" slot-scope="row">{{ row.value | moment("from") }}</template>
            <!-- hash -->
            <template slot="hash" slot-scope="row">
                <a :href="transactionBaseUrl+row.value" target="_blank">{{ row.value | trimAddress }}</a>
            </template>


        </b-table>
    </div>
</template>

<script>
    import { BTable  } from 'bootstrap-vue';

    export default {
        name: "ContentsTransactionsTable",
        props: {
            address: String
        },
        components: {
            BTable
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
                    { key: 'value', label: 'Amount', sortable: true, sortDirection: 'desc'  },
                    { key: 'from', label: 'From', sortable: true, sortDirection: 'desc'  },
                    { key: 'to', label: 'To', sortable: true, sortDirection: 'desc'  },
                    { key: 'timeStamp', label: 'Date', sortable: true, sortDirection: 'desc'  },
                    { key: 'hash', label: 'Reference', sortable: true, sortDirection: 'desc' }
                ],
                currentPage: 1,
                perPage: 7,
                filter: null,
                sortBy: 'created_at',
                sortDesc: true,
                sortDirection: 'desc',
                modal: {
                    hash: '',
                    timestamp: '',
                    from: '',
                    to: '',
                    value: '',
                },
            }
        },
        methods: {
            reduceSizeDecimal(number) {
                number = numeral(number).format('0,000.00');
                let stringNumber = number.toString(),
                    wholeNumber = stringNumber.slice(0, stringNumber.length-3),
                    decimals = stringNumber.slice(stringNumber.length-3, stringNumber.length);

                return `<p>
                        ${wholeNumber}
                        <span class="currency-decimals">${decimals}</span>
                        <span class="currency-symbol">MHLK</span>
                    </p>`;
            },
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

                        this.items = data.map( ({hash, timeStamp, from, to, value}) => {
                            return {
                                value: value,
                                from, from,
                                to: to,
                                timeStamp: new Date(timeStamp*1000),
                                hash: hash,
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
