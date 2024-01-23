<template>

    <Head :title="title" />


    <NavBar></NavBar>

    <Container>
        <main class="py-5">
            <slot />
        </main>
    </Container>

</template>

<script setup>

    import { Head } from '@inertiajs/vue3';

    import NavBar from '@/Components/navbar/Navbar.vue'
    import Container from '@/Components/Container.vue';

    defineProps({
        title: {
            type: String,
            required: true
        },
    });

</script>
