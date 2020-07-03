<template>
<div>
    <span class="text-md  font-semibold text-dark">
Please <a href="/login" @click.prevent="$modal.show('login')" class="text-blue link">sign in</a> to participate in this
                discussion.
    </span>
    <modal name="login" height="auto" :adaptive="true">
        <div class="float-right"><button class="btn btn-flat" @click="$modal.hide('login')">X</button></div>
        <div class="container px-10 py-8 p-3">
         <h2 class="lead align-text-center">Login</h2>
            <form class="px-10 py-8" @submit.prevent="login" @keydown="feedback = ''">
                <div class=" form-group mb-6">
                    <label for="username" class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2 ">Username</label>
                    <input type="text" class="w-full p-2 leading-normal form-control" style="border-radius: 15px;" id="username" name="username" autocomplete="username" placeholder="joe"  autofocus required v-model="form.username">
                </div>

                <div class="form-group mb-6">
                    <label for="password" class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2 ">Password</label>
                    <input type="password" class="w-full p-2 leading-normal form-control" style="border-radius: 15px;" id="password" name="password" autocomplete="current-password" required v-model="form.password">
                </div>

                <div class="flex justify-end items-center form-group">
                    <button type="submit" class="btn btn-outline-secondary btn-block rounded-pill" :class="loading ? 'loader' : ''" :disabled="loading">Log In</button>
                    <br>  DON'T HAVE ACCOUNT?
                    <a href="#" class="btn btn-outline-secondary text-grey-dark link rounded-pill" @click="register">REGISTER</a>
                </div>

                <div class="mt-6  p-2" v-if="feedback">
                    <span class="text-xs text-danger" v-text="feedback"></span>
                </div>
            </form>
        </div>
    </modal>
</div>
</template>

<script>
export default {
    data() {
        return {
            form: { username: "", password: "" },
            feedback: "",
            loading: false
        };
    },

    methods: {
        show () {
            this.$modal.show('login');
        },
        hide () {
            this.$modal.hide('login');
        },
        login() {
            this.loading = true;

            axios
                .post("/login", this.form, {
                    headers:{
                        'Content-Type':'application/json',
                        'Accept':'application/json'
                    }
                })
                .then(({data: { redirect }}) => {
                    location.assign(redirect);
                })
                .catch(error => {
                    this.feedback =
                        "The given credentials are incorrect. Please try again.";
                    this.loading = false;
                });
        },

        register() {
            this.$modal.hide("login");
            this.$modal.show("register");
        }
    }
};
</script>
<style>
login{
    padding:10px;
}
</style>   