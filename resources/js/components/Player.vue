<template>
    <div>
        <div :data-vimeo-id="lesson.video_id" data-vimeo-width="900" v-if="lesson" id="handstick"></div>
    </div>
</template>

<script>
    import Player from '@vimeo/player'
    import Axios from 'axios'
    import Swal from 'sweetalert'

    export default {

        props: ['default_lesson', 'next_lesson_url'],

        data() {
            return{
                lesson: JSON.parse(this.default_lesson)
            }
        },


        methods: {

            displayVideoEndedAlert(){

                Swal('Yaay!! You completed this lesson.').then(() => {
                    window.location = this.next_lesson_url
                })
            },

            completeLesson(){

                Axios.post(`/lesson/${this.lesson.id}/complete`,).then(res => {

                    this.displayVideoEndedAlert();
                    // console.log(res);

                }).catch(err => {
                    console.log(err);
                });
            }
        },

        mounted() {

            const player = new Player('handstick')

            player.on('ended', () => {
                this.completeLesson()
            })



        }



    }
</script>

<style scoped>

</style>