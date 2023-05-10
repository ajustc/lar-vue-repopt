<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Category</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="create">
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
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <router-view></router-view>
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
    name: "add-people",
    data() {
        return {
            people: {
                nama: "",
                tanggal_lahir: new Date(),
            },
            format,
        };
    },
    mounted() {
        console.log({ ref });
    },
    methods: {
        async create() {
            await this.axios
                .post("/api/people", this.people)
                .then((response) => {
                    this.$router.push({ name: "peopleList" });
                })
                .catch((error) => {
                    console.log({ error });
                });
        },
    },
};
</script>
