<template>
  <h1 class="text-center">Edit Pengguna</h1>
  <div class="text-right">
    <v-btn
      prepend-icon="mdi mdi-account-plus"
      @click="dialog_insert = true"
      theme="dark"
      class="rounded-lg"
    >
      Tambah pengguna
    </v-btn>
  </div>
  <v-card class="rounded-lg mt-5" theme="dark">
    <v-table class="mx-10 my-10" border="2">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nama</th>
          <th>NIK</th>
          <th>Username</th>
          <th>Nomor Telepon</th>
          <th>Level</th>
          <th class="text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(row, i) in data" :key="i++">
          <td>{{ i }}</td>
          <td>{{ row.nama }}</td>
          <td>{{ row.nik }}</td>
          <td>{{ row.username }}</td>
          <td>{{ row.tlp }}</td>
          <td>{{ row.level }}</td>
          <td align="center">
            <v-btn
              color="#7CB342"
              @click="edit(row.id)"
              icon="mdi mdi-account-edit"
              round
              variant="text"
            ></v-btn>
            <v-btn
              icon="mdi mdi-delete-forever"
              color="red"
              round
              variant="text"
              @click="konfirmasi(row.id)"
            ></v-btn>
          </td>
        </tr>
      </tbody>
    </v-table>
  </v-card>
  <v-dialog v-model="dialog_insert" width="600" theme="dark">
    <v-card class="rounded-shaped">
      <v-card-text>
        <v-form>
          <v-text-field
            v-model="form.nama"
            label="Nama Lengkap"
            :error-messages="errors.nama"
            variant="solo"
            prepend-inner-icon="mdi mdi-card-account-details"
          >
          </v-text-field>
          <v-text-field
            v-model="form.nik"
            label="NIK"
            variant="solo"
            prepend-inner-icon="mdi mdi-card-bulleted"
          >
          </v-text-field>
          <v-text-field
            v-model="form.username"
            label="Username"
            :error-messages="errors.username"
            prepend-inner-icon="mdi mdi-account-circle"
            variant="solo"
          >
          </v-text-field>
          <v-text-field
            type="password"
            v-model="form.password"
            label="Password"
            :error-messages="errors.password"
            variant="solo"
            prepend-inner-icon="mdi mdi-lock"
          >
          </v-text-field>
          <v-text-field
            v-model="form.tlp"
            label="No. Handphone"
            :error-messages="errors.tlp"
            variant="solo"
            prepend-inner-icon="mdi mdi-cellphone"
          >
          </v-text-field>
          <v-select
            label="Level"
            :items="['Admin', 'Petugas', 'Masyarakat']"
            :error-messages="errors.level"
            variant="solo"
            v-model="form.level"
            prepend-inner-icon="mdi mdi-account-group"
          >
          </v-select>
        </v-form>
      </v-card-text>
      <div class="d-flex justify-center mb-5">
        <v-card-actions>
          <v-btn
            class="text-red"
            @click="batal"
            prepend-icon="mdi mdi-close-box"
            >Batal</v-btn
          >
          <v-btn
            class="text-green"
            @click="simpan"
            prepend-icon="mdi mdi-content-save"
            >Simpan</v-btn
          >
        </v-card-actions>
      </div>
    </v-card>
  </v-dialog>
  <v-dialog v-model="dialog_hapus" width="290">
    <v-card theme="dark">
      <v-card-text>yakin ingin menghapus akun?</v-card-text>
      <div class="d-flex justify-center">
        <v-card-actions>
          <v-btn color="green" @click="hapus">Ya</v-btn>
          <v-btn color="red" @click="batal">Tidak</v-btn>
        </v-card-actions>
      </div>
    </v-card>
  </v-dialog>
</template>

<script>
import { router } from "@inertiajs/vue3";
import layoutVue from "../../layout/layout.vue";
export default {
  layout: layoutVue,
  props: {
    data: Array,
    errors: Object,
  },
  data() {
    return {
      dialog_insert: false,
      dialog_hapus: false,
      form: {
        id: "",
        nama: "",
        username: "",
        password: "",
        level: "",
        tlp: "",
      },
    };
  },
  methods: {
    batal() {
      (this.form.id = ""),
        (this.form.nik = ""),
        (this.form.nama = ""),
        (this.form.username = ""),
        (this.form.password = ""),
        (this.form.level = ""),
        (this.form.tlp = ""),
        (this.dialog_insert = false),
        (this.dialog_hapus = false);
    },
    simpan() {
      router.visit("/admin/user", {
        method: "post",
        data: {
          id: this.form.id,
          nik: this.form.nik,
          nama: this.form.nama,
          username: this.form.username,
          password: this.form.password,
          level: this.form.level,
          tlp: this.form.tlp,
        },
        preservedScroll: true,
        preservedState: true,
        onSuccess: () => {
          this.batal();
        },
      });
    },
    konfirmasi($id) {
      (this.dialog_hapus = true), (this.form.id = $id);
    },
    edit($id) {
      fetch("/admin/user/" + $id)
        .then((res) => res.json())
        .then((data) => {
          this.form.id = data.id;
          this.form.nama = data.nama;
          this.form.nik = data.nik;
          this.form.username = data.username;
          this.form.level = data.level;
          this.form.tlp = data.tlp;
          this.dialog_insert = true;
        });
    },
    hapus() {
      router.visit("/admin/user/" + this.form.id, {
        method: "delete",
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
          this.batal();
        },
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
