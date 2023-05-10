<template>
    <!-- <div class="container mt-5">
        <div class="col-12 text-center">
            <h1>ZXC</h1>
            <a href="https://techsolutionstuff.com/" target="_blank"
                >Visit For More Awesome Articles</a
            >
        </div>
    </div> -->
    <router-view>
    </router-view>

</template>

<script>
export default {
    mounted() {
        console.log("Welcome mounted.");
    },
};
</script>
