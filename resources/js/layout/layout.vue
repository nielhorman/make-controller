<template>
  <v-app class="bgp">
    <v-card class="bgpv">
      <v-row>
        <v-col>
          <h1 class="my-5 mx-15 text-red-darken-3">pajamma.</h1>
        </v-col>
        <v-col>
          <div class="float-right">
            <v-img src="/img/logo.jpg" cover height="100" width="100"></v-img>
          </div>
        </v-col>
      </v-row>
    </v-card>
    <v-navigation-drawer
      v-model="drawer"
      :rail="rail"
      permanent
      @click="rail = false"
      theme="dark"
    >
      <v-list-item class="ml-2" prepend-icon="mdi mdi-account-circle" nav>
        {{ level }}
        <template v-slot:append>
          <v-btn
            variant="text"
            icon="mdi-chevron-left"
            @click.stop="rail = !rail"
          ></v-btn>
        </template>
      </v-list-item>

      <v-divider></v-divider>

      <v-list density="compact" nav>
        <Link v-if="user.level == 'admin'" href="/admin" as="div">
          <v-list-item
            prepend-icon="mdi-home-city"
            title="Home"
            value="home"
            to="/admin"
          ></v-list-item>
        </Link>
        <Link v-if="user.level == 'petugas'" href="/petugas" as="div">
          <v-list-item
            prepend-icon="mdi-home-city"
            title="Home"
            value="home"
            to="/petugas"
          ></v-list-item>
        </Link>
        <Link v-if="user.level == 'admin'" href="/admin/user" as="div">
          <v-list-item
            prepend-icon="mdi-account-group-outline"
            title="Users"
            value="users"
            to="/admin/user"
          ></v-list-item>
        </Link>
        <Link v-if="user.level == 'admin'" href="/admin/register" as="div">
          <v-list-item
            prepend-icon="mdi mdi-account-check"
            title="Verifikasi User"
            value="userregis"
            to="/admin/register"
          ></v-list-item>
        </Link>
        <Link v-if="user.level == 'masyarakat'" href="/masyarakat" as="div">
          <v-list-item
            prepend-icon="mdi-home-city"
            title="Home"
            value="home"
            to="/masyarakat"
          ></v-list-item>
        </Link>
        <Link
          v-if="user.level == 'masyarakat'"
          href="/masyarakat/pengaduan"
          as="div"
        >
          <v-list-item
            prepend-icon="mdi mdi-bullhorn"
            title="Tempat Jamma"
            value="pengaduan"
            to="/masyarakat/pengaduan"
          ></v-list-item>
        </Link>
      </v-list>
      <template v-slot:append>
        <v-list>
          <v-list-item
            @click="logout"
            prepend-icon="mdi mdi-logout"
            title="Logout"
            value="logout"
          ></v-list-item>
        </v-list>
      </template>
    </v-navigation-drawer>
    <v-main>
      <v-container>
        <slot />
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import { router, Link } from "@inertiajs/vue3";
import { computed } from "vue";
export default {
  components: {
    Link,
  },
  data() {
    return {
      drawer: true,
      rail: true,
    };
  },
  computed: {
    user() {
      return this.$page.props.auth.user;
    },
    level() {
      return this.user.level[0].toUpperCase() + this.user.level.slice(1);
    },
  },
  methods: {
    logout() {
      router.get("/logout");
    },
  },
};
</script>

<style scoped>
@font-face {
  font-family: "inter";
  src: url("/fonts/static/Inter-Regular.ttf") format("truetype");
}
* {
  font-family: inter;
}
.bgp {
  background-color: #29b6f6;
}
.bgpv {
  background-color: #ffee58;
}
</style>
