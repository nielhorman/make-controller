<template>
  <v-app>
    <v-main class="bgp">
      <div class="d-flex justify-center mt-15">
        <v-card elevation="2" height="570" width="850" class="">
          <v-img
            src="/img/logo.jpg"
            cover
            height="100"
            width="100"
            class="mr-15 mt-5 float-right"
          ></v-img>
          <div class="mx-15 mt-15">
            <h1 color="white">Daftar yuk,</h1>
            <p>daftar mki dlu, biar bisa jadi pajamma</p>
          </div>
          <v-card-text>
            <v-form>
              <div class="mx-15">
                <v-text-field
                  :error-messages="errors.nama"
                  label="Nama Lengkap"
                  variant="solo"
                  prepend-inner-icon="mdi mdi-card-account-details"
                  v-model="form.nama"
                ></v-text-field>
                <v-text-field
                  :error-messages="errors.nik"
                  label="NIK"
                  variant="solo"
                  prepend-inner-icon="mdi mdi-card-bulleted"
                  v-model="form.nik"
                ></v-text-field>
                <v-text-field
                  :error-messages="errors.tlp"
                  label="Nomor Handphone"
                  prepend-inner-icon="mdi mdi-cellphone"
                  variant="solo"
                  v-model="form.tlp"
                ></v-text-field>
                <v-row>
                  <v-col>
                    <v-text-field
                      :error-messages="errors.username"
                      label="Username"
                      variant="solo"
                      v-model="form.username"
                      prepend-inner-icon="mdi mdi-account-circle"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    ><v-text-field
                      :error-messages="errors.password"
                      label="Password"
                      type="password"
                      variant="solo"
                      prepend-inner-icon="mdi mdi-lock"
                      v-model="form.password"
                    ></v-text-field
                  ></v-col>
                </v-row>
                <v-btn block color="white" @click="register" class="mt-3"
                  >REGISTER</v-btn
                >
                <div class="mt-3">
                  <a @click="login">Punya akun ?, login aza</a>
                </div>
              </div>
            </v-form>
          </v-card-text>
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
      form: {
        nama: "",
        nik: "",
        hp: "",
        username: "",
        password: "",
      },
    };
  },
  methods: {
    login() {
      router.get("/");
    },
    register() {
      router.post("register", this.form);
    },
  },
};
</script>

<style scoped>
.bgp {
  background: rgb(251, 255, 84);
  background: radial-gradient(
    circle,
    rgba(251, 255, 84, 1) 38%,
    rgba(255, 75, 75, 1) 62%,
    rgba(0, 212, 255, 1) 95%
  );
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
