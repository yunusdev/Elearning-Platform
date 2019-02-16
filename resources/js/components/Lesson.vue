<template>

    <div class="container text-center">
        <h1 class="text-center">
            <button class="btn btn-primary" @click="createNewLesson()">
                Create New Lesson
            </button>
        </h1>
        <ul class="list-group d-flex">
            <li class="list-group-item d-flex justify-content-between" v-for="lesson, key in lessons">
                {{lesson.title}}
                <p>
                    <button class="btn btn-primary btn-xs" @click="editLesson(lesson)">
                        Edit
                    </button>
                    <button class="btn btn-danger btn-xs" @click="deleteLesson(lesson.id, key)">
                        Delete
                    </button>
                </p>
            </li>

        </ul>
        <create-lesson></create-lesson>
    </div>
    
</template>

<script>
    import Axios from 'axios'

    export default {

        props: ['default_lessons', 'series_id'],

        components: {
            'create-lesson': require('./Children/CreateLesson.vue')
        },

        mounted(){

          this.$on('lesson_created', (lesson) => {

              this.lessons.push(lesson);

              window.noty({
                  'message': 'Lesson Created Successfully!',
                  'type': 'success'
              })

          });

          this.$on('lesson_edited', (lesson) => {

                // this.lesson = lesson
              // console.log(typeof this.lessons)

              const index = this.lessons.findIndex(item => item.id === lesson.id);

              this.lessons.splice(index, 1, lesson);

              window.noty({
                  'message': 'Lesson Updated Successfully!',
                  'type': 'success'
              })
            })


        },

        data(){

            return {

                lessons: JSON.parse(this.default_lessons),

            }

        },

        computed: {

        },

        methods: {

            createNewLesson(){

                this.$emit('create-new-lesson', this.series_id);

            },

            editLesson(lesson){

                this.$emit('edit_lesson', lesson)

            },

            deleteLesson(id, key){

                if (confirm('Are you sure you want to delete?')) {

                    Axios.delete(`/admin/${this.series_id}/lessons/${id}`)

                        .then((res) => {

                            console.log(res);
                            this.lessons.splice(key, 1)

                        }).catch((err) => {

                        console.log(err)
                    })

                }

            }

        },





    }
</script>

<style scoped>

</style>