<template>
    <div class="modal fade" id="createLesson" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{name}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" value="Introduction" placeholder="Lesson title" v-model="lesson.title">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" value="315528770" placeholder="Vimeo video id" v-model="lesson.video_id">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" value="120" placeholder="Episode numbers" v-model="lesson.episode_number">
                    </div>

                    <div class="form-group">
                        <textarea cols="30" rows="10" class="form-control" placeholder="Descriptions." v-model="lesson.description"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" v-model="lesson.premium"> Premium: {{lesson.premium}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click = "EditLesson()" v-if="editing" >Update lesson</button>
                    <button type="button" class="btn btn-primary" @click="createLesson()" v-else>Create lesson</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import Axios from 'axios'


    class Lesson{

        constructor(lesson){

            this.title = lesson.title || '';
            this.description = lesson.description || '';
            this.episode_number = lesson.episode_number || '';
            this.video_id = lesson.video_id || '';
            this.premium = lesson.premium || '';

        }
    }

    export default {


        mounted() {

            this.$parent.$on('create-new-lesson',  (seriesId) => {
                this.editing = false;
                this.lesson = new Lesson({});
                this.seriesId = seriesId;
                $('#createLesson').modal()

            });

            this.$parent.$on('edit_lesson', (lesson) => {

                this.editing = true;
                this.lesson = new Lesson(lesson);
                this.seriesId = lesson.series_id;
                this.lessonId = lesson.id;

                $('#createLesson').modal()

            })

        },

        data(){

            return{

                lesson: new Lesson({}),
                lessonId: '',
                editing: false,
                seriesId: "",
            }
        },


        methods: {

            createLesson() {

                Axios.post('/admin/' + this.seriesId + '/lessons', this.lesson)

                .then((res) => {

                    this.$parent.$emit('lesson_created', res.data);

                    $('#createLesson').modal('hide');


                }).catch((err) => {
                    console.log(err);

                });

            },

            EditLesson(){

                Axios.put(`/admin/${this.seriesId}/lessons/${this.lessonId}`, this.lesson)

                    .then((res) => {

                    this.$parent.$emit('lesson_edited', res.data);

                    $('#createLesson').modal('hide');


                }).catch((err) => {

                    console.log(err)

                })
            }

        },

        computed: {

            name(){

                if (this.editing == true){

                    return 'Edit Series'
                }

                return 'Create Series'

            }

        }


    }
</script>

