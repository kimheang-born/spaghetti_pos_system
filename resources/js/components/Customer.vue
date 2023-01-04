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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>183</td>
                                            <td>John Doe</td>
                                            <td>11-7-2014</td>
                                            <td><span class="tag tag-success">Approved</span></td>
                                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                        </tr>
                                        <tr>
                                            <td>219</td>
                                            <td>Alexander Pierce</td>
                                            <td>11-7-2014</td>
                                            <td><span class="tag tag-warning">Pending</span></td>
                                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                        </tr>
                                        <tr>
                                            <td>657</td>
                                            <td>Bob Doe</td>
                                            <td>11-7-2014</td>
                                            <td><span class="tag tag-primary">Approved</span></td>
                                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                        </tr>
                                        <tr>
                                            <td>175</td>
                                            <td>Mike Doe</td>
                                            <td>11-7-2014</td>
                                            <td><span class="tag tag-danger">Denied</span></td>
                                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                        </tr>
                                    </tbody>
                                </table>
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
                    <div class="modal-body">
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
                                <option value="1">Male</option>
                                <option value="0">Female</option>
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
                    address: "",
                    _token: this.token.value
                })
            }
        },
        methods: {
            newCustomer() {
                this.form.reset();
                $('#modal-cutomer').modal('show');
            },
            createCustomer() {
                this.form.post('/customer')
                    .then((response) => {
                        $('#modal-cutomer').modal('hide');
                        if (response.data.success) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Record has been successfully created.',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    })
                    .catch((error) => {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                            showConfirmButton: false,
                        })
                        console.log(error);
                    });
            }
        },
    }
</script>

<style lang="scss" scoped>
.swal-wide{
    width:850px !important;
}
</style>
