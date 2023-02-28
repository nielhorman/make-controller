<template>
  <v-app>
    <v-main class="bgp">
      <div class="d-flex justify-center mt-15">
        <v-card elevation="2" height="600" width="500" class="">
          <v-img
            src="/img/logo.jpg"
            cover
            height="100"
            width="100"
            class="ml-5 mt-5"
          ></v-img>
          <div class="ml-8">
            <h1 color="white">Welcome,</h1>
            <p>lakukan login untuk ma'jamma</p>
          </div>
          <v-card-text>
            <v-form>
              <div class="mx-15 mt-7">
                <v-text-field
                  label="Username"
                  v-model="formlogin.username"
                  variant="solo"
                  :error-messages="errors.username"
                  prepend-inner-icon="mdi mdi-account-circle"
                >
                </v-text-field>
                <v-text-field
                  label="Password"
                  type="password"
                  v-model="formlogin.password"
                  variant="solo"
                  :error-messages="errors.password"
                  prepend-inner-icon="mdi mdi-lock"
                >
                </v-text-field>

                <div v-if="$page.props.flash.message" class="alert">
                  <v-card height="65" width="347" color="red" v-model="err"
                    ><v-card-text class="text-center mb-10">
                      {{ $page.props.flash.message }}
                      <v-btn color="red" class="ml-3" @click="hilang">X</v-btn>
                    </v-card-text></v-card
                  >
                </div>
                <v-btn block color="white" @click="login" class="mt-3"
                  >LOGIN</v-btn
                >
                <div class="mt-3">
                  <a @click="register">Belum Punya Akun ?, Daftar yuk</a>
                </div>
              </div>
            </v-form>
          </v-card-text>
        </v-card>
        <v-card elevation="2" height="600" width="350" class="">
          <v-carousel hide-delimiters cycle height="600" :show-arrows="false">
            <v-carousel-item
              v-for="(item, i) in items"
              :key="i"
              :src="item.src"
              cover
            >
            </v-carousel-item>
          </v-carousel>
        </v-card>
      </div>
    </v-main>
  </v-app>
</template>

<script>
import { router } from "@inertiajs/vue3";
export default {
  props: {
    errors: Object,
  },
  data() {
    return {
      formlogin: {
        username: "",
        password: "",
      },
      items: [
        {
          src: "/img/carousel.jpg ",
        },
        {
          src: "/img/carousel2.jpg",
        },
      ],
    };
  },
  methods: {
    login() {
      router.post("/login", this.formlogin);
    },
    register() {
      router.get("/register");
    },
    hilang() {
      router.get("/");
    },
  },
};
</script>

<style scoped>
.bgp {
  background-color: #29b6f6;
}
.slides {
  color: black;
}
@font-face {
  font-family: "inter";
  src: url("/fonts/static/Inter-Regular.ttf") format("truetype");
}
* {
  font-family: inter;
}
</style>
