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
            class="col"
            v-for="(doctor, column) in doctorInRow(row)"
            :key="'row' + row + column"
          >
            <doctor-list-item
              :name="doctor.name"
              :description="doctor.description"
              :price="1500"
            ></doctor-list-item>
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
    doctorInRow(row) {
      return this.doctors.slice((row - 1) * this.columns, row * this.columns);
    },
    placeHolederInRow(row) {
      return this.columns - this.doctorInRow(row).length;
    },
  },
  created() {
    this.isLoading = true;

    setTimeout(() => {
      this.doctors = [
        {
          name: "doctorXXX",
          description: "lorem ipsum dol amet",
        },
        {
          name: "doctorYYY",
          description: "lorem ipsum dol amet",
        },
        {
          name: "doctorZZZ",
          description: "lorem ipsum dol amet",
        },
        {
          name: "doctorAAA",
          description: "lorem ipsum dol amet",
        },
        {
          name: "doctorBBB",
          description: "lorem ipsum dol amet",
        },
        {
          name: "doctorCCC",
          description: "lorem ipsum dol amet",
        },
        {
          name: "doctorDDD",
          description: "lorem ipsum dol amet",
        },
        {
          name: "doctorEEE",
          description: "lorem ipsum dol amet",
        },
      ];
      this.isLoading = false;
    }, 2000);
  },
};
</script>
