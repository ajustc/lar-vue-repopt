<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update People</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="update">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="people.nama"
                                    />
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <VueDatePicker
                                        :format="format"
                                        :preview-format="format"
                                        v-model="people.tanggal_lahir"
                                    ></VueDatePicker>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from "vue";
const date = ref(new Date());
// In case of a range picker, you'll receive [Date, Date]
const format = (date) => {
    const day = date.getDate();
    const month = date.getMonth() + 1;
    const year = date.getFullYear();

    return `${year}-${month}-${day}`;
};
export default {
    name: "update-people",
    data() {
        return {
            people: {
                nama: "",
                tanggal_lahir: "",
                _method: "put",
            },
            format
        };
    },
    mounted() {
        this.showPeople();
    },
    methods: {
        async showPeople() {
            await this.axios
                .get(`/api/people/${this.$route.params.id}`)
                .then((response) => {
                    console.log({ response });
                    const { nama, tanggal_lahir } = response.data.data;
                    this.people.nama = nama;
                    this.people.tanggal_lahir = tanggal_lahir;
                })
                .catch((error) => {
                    console.log({ error });
                });
        },
        async update() {
            await this.axios
                .post(`/api/people/${this.$route.params.id}`, this.people)
                .then((response) => {
                    console.log({ response });
                    this.$router.push({ name: "peopleList" });
                })
                .catch((error) => {
                    console.log({ error });
                });
        },
    },
};
</script>
