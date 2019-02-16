<template>

    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="card card-shadowed p-50 w-400 mb-0" style="max-width: 100%">
                <h5 class="text-uppercase text-center">Login</h5>
                <br><br>

                <form>
                    <div class="form-group">
                        <input type="email" class="form-control" v-model="email" placeholder="Email">
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" v-model="password" placeholder="Password">
                    </div>

                    <div class="form-group flexbox py-10">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" v-model="remember" checked="">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">Remember me</span>
                        </label>

                        <a class="text-muted hover-primary fs-13" href="#">Forgot password?</a>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-bold btn-block btn-primary" @click = "attemptLogin()" :disabled="!isValidForm" type="submit">Login</button>
                    </div>
                </form>

                <div class="divider">Or Sign In With</div>
                <div class="text-center">
                    <a class="btn btn-circular btn-sm btn-facebook mr-4" href="#"><i class="fa fa-facebook"></i></a>
                    <a class="btn btn-circular btn-sm btn-google mr-4" href="#"><i class="fa fa-google"></i></a>
                    <a class="btn btn-circular btn-sm btn-twitter" href="#"><i class="fa fa-twitter"></i></a>
                </div>

                <hr class="w-30">

                <p class="text-center text-muted fs-13 mt-20">Don't have an account? <a href="page-register.html">Sign up</a></p>
            </div>
        </div>
    </div>

</template>

<script>

    import axios from 'axios'

    export default {

        data() {

            return{

                email: '' ,
                password: '',
                remember: true,
                isLoading: false

            }


        },

        methods: {

            isEmailValid() {

                if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email)) {
                    return true;
                }else{

                    return false;


                }
            },

            attemptLogin(){

                this.isLoading = true

                axios.post('/login', {

                    email: this.email, password: this.password, remember: this.remember

                }).then(function(response){

                    location.reload()

                }).catch(function(error){

                    this.isLoading = false
                    console.log(error)

                })


            }

        },

        computed:  {

            isValidForm(){

                return this.isEmailValid() && this.password && !isLoading
            }

        }
    }
</script>
