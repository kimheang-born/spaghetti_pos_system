<template>
<div>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Starter Page</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/home">ទំព័រដើម</a></li>
                            <li class="breadcrumb-item active">ព័ត៌មានអតិថិជន</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <button
                                        @click="newCustomer"
                                        class="btn btn-sm btn-outline-primary"
                                    >
                                        បន្ថែមព័ត៌មានអតិថិជនថ្មី<i class="fas fa-plus ml-1"></i>
                                    </button>
                                </div>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input
                                            type="text"
                                            name="table_search"
                                            class="form-control float-right"
                                            placeholder="Search"
                                        />
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table aria-labelledby="customer" class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>លេខ</th>
                                            <th>ឈ្មោះ</th>
                                            <th>ភេទ</th>
                                            <th>លេខទូរស័ព្ទ</th>
                                            <th>អាសយដ្ឋាន</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="customers.length > 0">
                                        <tr
                                            v-for="customer in customers"
                                            :key="customer.id"
                                        >
                                            <td>{{ customer.id }}</td>
                                            <td>{{ customer.name }}</td>
                                            <td v-if="customer.gender">ប្រុស</td>
                                            <td v-else>ស្រី</td>
                                            <td>{{ customer.phone }}</td>
                                            <td>{{ customer.address }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" @click="infoCustomer(customer)" class="btn btn-outline-primary btn-sm">កែប្រែ</button>
                                                    <button type="button" class="btn btn-outline-danger btn-sm">លុប</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="6">No data</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="card-footer">
                                    <div class="pagination-content float-right">
                                        <pagination v-model="page" :records="200" @paginate="getCustomers"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-cutomer">
        <div class="modal-dialog">
            <div class="modal-content">
                <form
                    @submit.prevent="createCustomer"
                    @keydown="form.onKeydown($event)"
                    role="form"
                    method="post"
                >
                    <div class="modal-header">
                        <h4 class="modal-title">ព័ត៌មានអតិថិជន</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" v-if="loading">Loading...</div>
                    <div class="modal-body" v-else>
                        <div class="form-group">
                            <label for="name">ឈ្មោះអថិជន</label>
                            <input
                                v-model="form.name"
                                :class="form.errors.has('name') ? 'is-invalid' : ''"
                                type="text"
                                class="form-control"
                                name="name"
                                id="name"
                                placeholder="ឈ្មោះអថិជន"
                            >
                            <span class="error invalid-feedback d-block" v-if="form.errors.has('name')" v-html="form.errors.get('name')" />
                        </div>
                        <div class="form-group">
                            <label for="gender">ភេទ</label>
                            <select
                                v-model="form.gender"
                                :class="form.errors.has('gender') ? 'is-invalid' : ''"
                                name="gender"
                                class="form-control"
                                id="gender"
                            >
                                <option value="1">ប្រុស</option>
                                <option value="0">ស្រី</option>
                            </select>
                            <span class="error invalid-feedback d-block" v-if="form.errors.has('gender')" v-html="form.errors.get('gender')" />
                        </div>
                        <div class="form-group">
                            <label for="phone">លេខទូរស័ព្ទ</label>
                            <input
                                v-model="form.phone"
                                :class="form.errors.has('phone') ? 'is-invalid' : ''"
                                type="text"
                                class="form-control"
                                name="phone"
                                id="phone"
                                placeholder="លេខទូរស័ព្ទ"
                            >
                            <span class="error invalid-feedback d-block" v-if="form.errors.has('phone')" v-html="form.errors.get('phone')" />
                        </div>
                        <div class="form-group">
                            <label for="address">អាសយដ្ឋាន</label>
                            <textarea
                                v-model="form.address"
                                :class="form.errors.has('address') ? 'is-invalid' : ''"
                                name="address"
                                class="form-control"
                                id="address"
                                rows="3"
                                placeholder="អាសយដ្ឋាន"
                            ></textarea>
                            <span class="error invalid-feedback d-block" v-if="form.errors.has('address')" v-html="form.errors.get('address')" />
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">បោះបង់<i class="fas fa-times ml-1"></i></button>
                        <button
                            type="submit"
                            class="btn btn-primary"
                            :disabled="form.busy"
                        >
                            រក្សាទុក<i class="fas fa-save ml-1"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        props: ['token'],
        data() {
            return {
                form: new Form({
                    id: "",
                    name: "",
                    gender: "1",
                    phone: "",
                    address: "",
                    _token: this.token.value
                }),
                customers: {},
                page: 1,
                loading: true,
            }
        },
        mounted() {
            this.getCustomers();

            Fire.$on('onCreated', (page = 1) => {
                this.getCustomers(page);
            });
        },
        computed: {
            numberOfRecords() {
                return this.customers.length;
            },
        },
        methods: {
            newCustomer() {
                this.form.reset();
                $('#modal-cutomer').modal('show');
            },
            infoCustomer(customer) {
                this.form.reset();
                this.form.fill(customer);
                $('#modal-cutomer').modal('show');
            },
            createCustomer() {
                this.form.post('customer')
                    .then((response) => {

                        Fire.$emit('onCreated', 1);

                        $('#modal-cutomer').modal('hide');

                        if (response.data.success) {
                            this.$toasted.success(response.data.message, { 
                                theme: "toasted-primary", 
                                position: "top-right", 
                                keepOnHover: true,
                                duration : 3000,
                            });
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            async getCustomers(page = 1) {
                await axios.get('customers', {
                                params: {
                                    page: page
                                }
                            })
                            .then((response) => {
                                this.customers = response.data.data;
                            })
                            .catch((error) => {
                                console.log(error);
                            })
                            .finally(() => this.loading = false);
            }
        },
    }
</script>

<style lang="scss" scoped></style>
