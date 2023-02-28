<template>
  <h1 class="text-center">Verifikasi User</h1>
  <v-card class="rounded-xl" theme="dark">
    <v-table class="mx-10 my-10" border="2">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nama</th>
          <th>NIK</th>
          <th>Username</th>
          <th>Nomor Telepon</th>
          <th class="text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(row, i) in reg" :key="i++">
          <td>{{ i }}</td>
          <td>{{ row.nama }}</td>
          <td>{{ row.nik }}</td>
          <td>{{ row.username }}</td>
          <td>{{ row.tlp }}</td>
          <td align="center">
            <v-btn
              color="#7CB342"
              @click="konfirmasi(row.id)"
              icon="mdi mdi-check-circle"
              round
              variant="text"
            ></v-btn>
          </td>
        </tr>
      </tbody>
    </v-table>
  </v-card>
</template>

<script>
import { router } from "@inertiajs/vue3";
import layoutVue from "../../layout/layout.vue";
export default {
  layout: layoutVue,
  props: {
    reg: Array,
  },
  methods: {
    konfirmasi($id) {
      router.visit("/admin/register/" + $id, {
        method: "get",
        preserveScroll: true,
        preserveState: true,
      });
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
</style>
