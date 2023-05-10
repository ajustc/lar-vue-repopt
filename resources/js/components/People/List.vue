<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <router-link :to="{ name: 'peopleAdd' }" class="btn btn-primary"
                >Create</router-link
            >
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>People Lists</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <input
                            v-on:keyup="findPeople"
                            v-model="find.nama"
                            type="text"
                            class="form-control mb-3"
                            placeholder="Search by name..."
                        />
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Dibuat oleh</th>
                                </tr>
                            </thead>
                            <tbody v-if="people.length > 0">
                                <tr v-for="(people, key) in people" :key="key">
                                    <td>{{ people.nama }}</td>
                                    <td>{{ people.tanggal_lahir }}</td>
                                    <td>
                                        <router-link
                                            :to="{
                                                name: 'peopleEdit',
                                                params: { id: people.id },
                                            }"
                                            class="btn btn-success"
                                            >Edit</router-link
                                        >
                                        <button
                                            type="button"
                                            @click="deleteCategory(people.id)"
                                            class="btn btn-danger"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="4" align="center">
                                        No Peoples Found.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "people",
    data() {
        return {
            people: [],
            find: {
                nama: "",
            },
        };
    },
    mounted() {
        this.getPeoples();
    },
    methods: {
        async findPeople() {
            const nama = this.find.nama;
            if (nama === '') {
                this.getPeoples();
            } else {
                await this.axios
                    .get("/api/people/find/" + nama)
                    .then((response) => {
                        console.log({ response });
                        this.people = response.data.data;
                    })
                    .catch((error) => {
                        console.log({ error });
                        this.people = [];
                    });
            }
        },
        async getPeoples() {
            await this.axios
                .get("/api/people")
                .then((response) => {
                    console.log({ response });
                    this.people = response.data.data;
                })
                .catch((error) => {
                    console.log({ error });
                    this.people = [];
                });
        },
        deleteCategory(id) {
            if (confirm("Are you sure to delete this people ?")) {
                this.axios
                    .delete(`/api/people/${id}`)
                    .then((response) => {
                        console.log({ response });
                        this.getPeoples();
                    })
                    .catch((error) => {
                        console.log({ error });
                    });
            }
        },
    },
};
</script>
