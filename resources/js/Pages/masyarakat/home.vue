<template>
  <div class="d-flex justify-center">
    <v-card
      class="my-8 rounded-xl"
      width="600"
      v-if="datas.length"
      theme="dark"
    >
      <v-card-text>
        <v-list lines="three">
          <v-list-item v-for="row in datas" :key="row.id">
            <v-list-item-title
              >{{ row.nama }} - {{ row.nik }}
            </v-list-item-title>
            <v-list-item-title>{{ row.tgl_pengaduan }}</v-list-item-title>
            <v-list-item-subtitle>
              <p v-html="row.isi"></p>
            </v-list-item-subtitle>

            <v-list-item-subtitle>
              <span v-if="row.status == '0'" class="text-red"
                >Belum Diproses
              </span>
              <span v-if="row.status == 'proses'" class="text-orange"
                >Proses
              </span>
              <span v-if="row.status == 'selesai'" class="text-green"
                >Selesai
              </span>
            </v-list-item-subtitle>

            <v-divider class="mt-4" />

            <template v-slot:prepend>
              <v-avatar color="grey-lighten-1">
                <v-img
                  class="bg-white"
                  width="300"
                  :aspect-ratio="1"
                  :src="'/storage/' + row.foto"
                  cover
                ></v-img>
              </v-avatar>
            </template>
            <template v-slot:append> </template>
          </v-list-item>
        </v-list>
      </v-card-text>
    </v-card>
  </div>
</template>

<script>
import layoutVue from "../../layout/layout.vue";
export default {
  layout: layoutVue,
  props: {
    datas: Array,
  },
};
</script>

<style>
@font-face {
  font-family: "inter";
  src: url("/fonts/static/Inter-Regular.ttf") format("truetype");
}
* {
  font-family: inter;
}
</style>
