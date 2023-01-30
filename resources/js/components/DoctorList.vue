<template>
  <div class="row justify-content-center">
    <div class="col-md-12">
      <h1 class="h3 my-3">Doctor List</h1>

      <div
        class="row"
        v-if="isLoading"
      >
        <p>data is loading...</p>
      </div>
      <div v-else>

        <div
          class="row mb-4"
          v-for="row in rows"
          :key="'row' + row"
        >
          <div
            class="col d-flex align-item-stretch"
            v-for="(doctor, column) in doctorsInRow(row)"
            :key="'row' + row + column"
          >
            <doctor-list-item v-bind="doctor"></doctor-list-item>
          </div>
          <div
            class="col"
            v-for="p in placeHolederInRow(row)"
            :key="'placeholder' + row + p"
          ></div>
        </div>

      </div>
    </div>
  </div>

</template>

<script>
import DoctorListItem from "./DoctorListItem";

export default {
  components: {
    DoctorListItem,
  },
  data() {
    return {
      isLoading: false,
      doctors: null,
      columns: 3,
    };
  },
  computed: {
    rows() {
      return this.doctors === null
        ? 0
        : Math.ceil(this.doctors.length / this.columns);
    },
  },
  methods: {
    doctorsInRow(row) {
      return this.doctors.slice((row - 1) * this.columns, row * this.columns);
    },
    placeHolederInRow(row) {
      return this.columns - this.doctorsInRow(row).length;
    },
  },
  created() {
    this.isLoading = true;

    const result = axios.get("/api/doctors").then((result) => {
      this.doctors = result.data.data;
      this.isLoading = false;
      // this.doctors.push({ name: "X", email: "x" });
    });
  },
};
</script>
