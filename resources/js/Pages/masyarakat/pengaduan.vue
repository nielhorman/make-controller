<template>
  <div class="mt-6 d-flex justify-center">
    <v-card width="600" theme="dark" class="rounded-xl">
      <v-card-text>
        <v-form>
          <v-file-input
            :rules="rules"
            accept="image/png, image/jpeg, image/bmp"
            prepend-icon="mdi-camera"
            label="Pilih Foto"
            variant="outlined"
            @input="form.foto = $event.target.files[0]"
          ></v-file-input>
        </v-form>
        <div class="my-3 font-weight-medium">Pengaduan:</div>

        <QuillEditor v-model:content="form.isi" contentType="html" />
      </v-card-text>
      <v-card-actions class="d-flex justify-center">
        <v-btn color="red" @click="kirim" block>laporkan</v-btn>
      </v-card-actions>
    </v-card>
  </div>
  <div class="d-flex justify-center">
    <v-card class="my-8 rounded-xl" width="600" v-if="datas.length" theme="dark">
      <v-card-text>
        <v-list lines="three">
          <v-list-item v-for="row in datas" :key="row.id">
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

            <v-list-item-subtitle>
              <tanggapan :id="row.id" />
            </v-list-item-subtitle>

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

            <template v-slot:append>
              <v-menu>
                <template v-slot:activator="{ props }">
                  <v-btn
                    color="grey-lighten-1"
                    icon="mdi-information"
                    variant="text"
                    v-bind="props"
                  >
                  </v-btn>
                </template>
                <v-list>
                  <v-list-item @click="hapus(row.id)">hapus</v-list-item>
                </v-list>
              </v-menu>
            </template>
          </v-list-item>
        </v-list>
      </v-card-text>
    </v-card>
  </div>
</template>

<script>
import { router, useForm } from "@inertiajs/vue3";
import layoutVue from "../../layout/layout.vue";
import tanggapan from "../components/tanggapan.vue";
export default {
  layout: layoutVue,
  components: {
    tanggapan,
  },
  props: {
    datas: Array,
  },
  data() {
    return {
      form: useForm({
        foto: null,
        isi: "",
      }),
    };
  },
  methods: {
    kirim() {
      router.post("/masyarakat/pengaduan", this.form, {
        methods: "post",
        forceFormData: true,
        preserveState: false,
        preserveScroll: false,
        onSuccess: () => {
          this.batal();
        },
      });
    },
    batal() {
      this.form.foto = null;
      this.form.isi = "";
    },
    hapus($id) {
      router.visit("/masyarakat/pengaduan/" + $id, {
        method: "delete",
        preserveState: false,
        preserveScroll: false,
      });
    },
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
