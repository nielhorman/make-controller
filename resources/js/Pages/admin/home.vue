<template>
  <div>
    <v-btn
      color="red-darken-3 mt-6"
      @click="tableToExcel('table', 'Lorem Table')"
      prepend-icon="mdi mdi-download"
      >Unduh Laporan</v-btn
    >
  </div>
  <v-table class="rounded-xl mt-6" theme="dark">
    <thead>
      <tr>
        <th>#</th>
        <th>NIK</th>
        <th>NAMA</th>
        <th>PENGADUAN</th>
        <th>GAMBAR</th>
        <th>STATUS</th>
        <th class="text-center">AKSI</th>
      </tr>
    </thead>

    <tbody>
      <tr v-for="(row, i) in datas" :key="i++">
        <td>{{ i }}</td>
        <td>{{ row.nik }}</td>
        <td>{{ row.nama }}</td>
        <td>
          <p v-html="row.isi" />
        </td>
        <td>
          <v-img :src="'/storage/' + row.foto" style="width: 50px" />
        </td>
        <td>
          <span v-if="row.status == '0'" class="text-red">Belum Diproses </span>
          <span v-if="row.status == 'proses'" class="text-orange">Proses </span>
          <span v-if="row.status == 'selesai'" class="text-green"
            >Selesai
          </span>
        </td>
        <td align="center">
          <v-menu>
            <template v-slot:activator="{ props }">
              <v-btn
                variant="text"
                v-bind="props"
                icon="mdi mdi-account-hard-hat"
              ></v-btn>
            </template>

            <v-list>
              <v-list-item
                v-if="row.status == '0'"
                @click="(event) => openproses(row.id)"
              >
                <v-list-item-title>Proses</v-list-item-title>
              </v-list-item>
              <v-list-item
                v-if="row.status == 'proses'"
                @click="(event) => openselesai(row.id)"
              >
                <v-list-item-title>Selesai</v-list-item-title>
              </v-list-item>
            </v-list>
          </v-menu>
        </td>
      </tr>
    </tbody>
  </v-table>
  <v-dialog v-model="dialog_insert" width="600">
    <v-card>
      <v-card-text>
        <QuillEditor v-model:content="tanggapan" contentType="html" />
      </v-card-text>
      <v-card-actions>
        <v-btn v-show="!show" color="primary" @click="tanggapi">Tanggapi</v-btn>
        <v-btn v-show="show" color="primary" @click="selesai">Selesai</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
  <div style="display: none">
    <table ref="table">
      <thead>
        <tr>
          <th>#</th>
          <th>NIK</th>
          <th>NAMA</th>
          <th>PENGADUAN</th>
          <th>STATUS</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="(row, i) in datas" :key="i++">
          <td>{{ i }}</td>
          <td>{{ row.nik }}</td>
          <td>{{ row.nama }}</td>
          <td>
            <p v-html="row.isi" />
          </td>
          <td>
            <span v-if="row.status == '0'" class="text-red"
              >Belum Diproses
            </span>
            <span v-if="row.status == 'proses'" class="text-orange"
              >Proses
            </span>
            <span v-if="row.status == 'selesai'" class="text-green"
              >Selesai
            </span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { router } from "@inertiajs/vue3";
// import { throws } from 'assert';
import layoutVue from "../../layout/layout.vue";
export default {
  layout: layoutVue,
  props: {
    datas: Array,
  },
  data() {
    return {
      id_pengaduan: "",
      tanggapan: "",
      dialog_insert: false,
      show: false,
      uri: "data:application/vnd.ms-excel;base64,",
      template:
        '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
      base64: function (s) {
        return window.btoa(unescape(encodeURIComponent(s)));
      },
      format: function (s, c) {
        return s.replace(/{(\w+)}/g, function (m, p) {
          return c[p];
        });
      },
    };
  },
  methods: {
    openproses($id) {
      this.id_pengaduan = $id;
      this.dialog_insert = true;
      this.show = false;
    },
    openselesai($id) {
      this.id_pengaduan = $id;
      this.dialog_insert = true;
      this.show = true;
    },
    tanggapi() {
      router.visit("/petugas/tanggapan/proses", {
        method: "post",
        data: {
          id_pengaduan: this.id_pengaduan,
          tanggapan: this.tanggapan,
        },
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
          this.dialog_insert = false;
          this.id_pengaduan = "";
          this.tanggapan = "";
        },
      });
    },
    selesai() {
      router.visit("/petugas/tanggapan/selesai", {
        method: "post",
        data: {
          id_pengaduan: this.id_pengaduan,
          tanggapan: this.tanggapan,
        },
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
          this.dialog_insert = false;
          this.id_pengaduan = "";
          this.tanggapan = "";
        },
      });
    },
    tableToExcel(table, name) {
      if (!table.nodeType) table = this.$refs.table;
      var ctx = { worksheet: name || "Worksheet", table: table.innerHTML };
      window.location.href =
        this.uri + this.base64(this.format(this.template, ctx));
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
