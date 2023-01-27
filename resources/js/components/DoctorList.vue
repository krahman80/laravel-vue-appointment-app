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
      <div
        class="row g-3"
        v-else
      >
        <doctor-list-item
          :name="doctor.name"
          :description="doctor.description"
          :price="1500"
          v-for="(doctor, index) in doctors"
          v-bind:key="index"
        ></doctor-list-item>
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
    };
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
