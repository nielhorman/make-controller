<template>
    <v-btn @click="tampilkan" class="mt-3" color="blue">Tanggapan</v-btn>
    <v-sheet v-show="show" class="mx-auto mt-3" height="100" width="100"><p v-html="isi"></p></v-sheet>
</template>

<script>
// import { router } from '@inertiajs/core'
export default {
  props: ["id"],
  data() {
    return {
      show: false,
      isi: "",
    };
  },
  methods: {
    tampilkan() {
      this.show = !this.show;
    },
    getTanggapan() {
      fetch("/masyarakat/tanggapan/" + this.id)
        .then((res) => res.json())
        .then((data) => {
          this.isi = data.tanggapan;
        });
    },
  },
  created() {
    this.getTanggapan();
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
