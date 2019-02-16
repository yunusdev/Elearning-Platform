<template>

    <div></div>
    
</template>

<script>

    import Swal from 'sweetalert'

    export default {

        created() {

            window.events.$on('notification', (payload) => {

                Swal(payload.message)
            });

        }


    }
</script>

<style scoped>

</style>