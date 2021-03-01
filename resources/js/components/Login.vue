<template name="signin">
<div>
    <div class="min-h-screen flex items-center justify-center bg-gray-10 py-8 px-4 sm:px-6 lg:px-8 animate__animated animate__fadeInUp">
  <div class="max-w-sm w-full space-y-8 bg-white rounded-lg px-5 py-6 shadow-md ">
    <div>
      <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
        Sign in
      </h2>
    </div>
    <form class="mt-8 space-y-6" @submit.prevent="login()">
      <input type="hidden" name="remember" value="true">
      <div class="rounded-md -space-y-px">
        <div class="mb-3">
          <label for="username" class="sr-only">Username</label>
          <input id="username" name="username" type="text" autocomplete="username" required class="w-full appearance-none rounded relative block px-3 py-2 border border-gray-500 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-10 focus:z-10 sm:text-sm" placeholder="Username" v-model="form.username">
        </div>
        <div>
          <label for="password" class="sr-only">Password</label>
          <input id="password" name="password" type="password" autocomplete="current-password" required class=" rounded appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-500 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password" v-model="form.password">
        </div>
      </div>

      <div class="flex items-center justify-between mt-2">
        <div class="flex items-center">
          <input id="remember_me" name="remember_me" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
          <label for="remember_me" class="ml-2 block text-sm text-gray-900">
            Remember me
          </label>
        </div>
        <flashMessage></flashMessage>

        <div class="text-sm">
          <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
            Forgot your password?
          </a>
        </div>
      </div>

      <div class="mt-5 mb-6">
        <button type="submit" class="w-full items-center px-4 py-2 bg-dark border border-transparent rounded-full p-2 font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-300focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">          Sign in
        </button>
      </div>
    </form>
  </div>
</div>
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
                    this.flashMessage.error({"message" :
                        "The given credentials are incorrect. Please try again."});
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
