<template>
<div>
    <div class="bg-grey-lighter min-h-screen flex flex-col">
            <div class="container max-w-sm mx-auto w-16  lg:w-8/12 md:w-15 flex-1 flex flex-col items-center justify-center px-2">
                <div class="bg-white px-6 py-8 rounded shadow-md text-black w-8/12">
                    <h1 class="mb-8 text-3xl text-center">Sign up</h1>

                    <input
                        type="text"
                        class="block border border-grey-light w-full p-2 rounded mb-4"
                        name="fullname"
                        placeholder="Full Name" v-model="form.name" required/>

                    <input
                        type="text"
                        class="block border border-grey-light w-full p-2 rounded mb-4"
                        name="username"
                        placeholder="Username" v-model="form.username" required/>

                     <input
                        type="text"
                        class="block border border-grey-light w-full p-2 rounded mb-4"
                        name="email"
                        placeholder="something@mail.com" v-model="form.email" required/>

                    <input
                        type="text"
                        class="block border border-grey-light w-full p-2 rounded mb-4"
                        name="location"
                        placeholder="Location" v-model="form.location" required/>
                        <label for="sex">Gender</label>
                    <select
                        class="block border border-grey-light w-full p-2 rounded mb-4"
                        name="sex"
                        id="sex"
                        v-model="form.sex" required>
                            <option disabled>select gender</option>
                            <option value="female">Female</option>
                            <option value="male">Male</option>
                    </select>

                    <input
                        type="password"
                        class="block border border-grey-light w-full p-2 rounded mb-4"
                        name="password"
                        placeholder="Password" v-model="form.password" required/>
                    <input
                        type="password"
                        class="block border border-grey-light w-full p-2 rounded mb-4"
                        name="password_confirmation"
                        placeholder="Confirm Password" v-model="form.password_confirmation" required/>
                        <label for="date">Date of Birth</label>
                    <input
                        id="date"
                        type="date"
                        class="block border border-grey-light w-full p-2 rounded mb-4"
                        name="birthday"
                        v-model="form.birthday" required/>
                        <pulse-loader :loading="loading" :color="color" :size="size"></pulse-loader>
                    <button
                        type="submit"
                        @click="register()"
                        class="w-full text-center py-3 rounded bg-blue-700 text-white hover:bg-green-dark focus:outline-none my-1"
                    >Create Account</button>
                <div class="text-grey-dark text-center mt-6">
                    Already have an account?
                    <a class="no-underline border-b border-blue text-blue" href="../login/">
                        Log in
                    </a>.
                </div>
                    <div class="text-center text-sm text-grey-dark mt-4">
                        By signing up, you agree to the
                        <a class="no-underline border-b border-grey-dark text-grey-dark" href="#">
                            Terms of Service
                        </a> and
                        <a class="no-underline border-b border-grey-dark text-grey-dark" href="#">
                            Privacy Policy
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import { PulseLoader } from 'vue-spinner/dist/vue-spinner.min.js';
export default {
components:{ PulseLoader },

    data() {
        return {
            form: {
                name: "",
                username: "",
                email: "",
                sex: "",
                location:"",
                password:"",
                password_confirmation:"",
                birthday:""

            },
            feedback: "",
            loading: false,
            errors: {},
            size:"15px",
            color:"#035",

        };
    },

    methods: {
         show () {
            this.$modal.show('register');
        },
        hide () {
            this.$modal.hide('register');
        },
        register() {
            this.loading = true;

            axios
                .post("/register", this.form)
                .then(response => {
                    location.reload();
                })
                .catch(error => {
                    this.errors = error.response.data.errors;

                    this.loading = false;
                });
        },
        Login() {
            this.$modal.hide("register");
            this.$modal.show("login");
        }
    }
};
</script>
