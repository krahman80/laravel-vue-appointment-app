<template>
  <div class="row justify-content-center">
    <div v-if="isLoading" class="text-muted text-center">
      data is loading ...
    </div>

    <div class="col-md-12" v-else>
      <div>
        <div class="row py-3">
          <div class="col-8 mx-auto">
            <div class="p-1 bg-white rounded rounded-pill shadow-sm mb-4">
              <div class="input-group">
                <input
                  type="search"
                  placeholder="What are you search for?"
                  aria-describedby="button-addon1"
                  class="form-control border-0 bg-white shadow-none"
                  v-model="keyword"
                />
                <div class="input-group-append">
                  <button
                    id="button-addon1"
                    type="submit"
                    class="btn btn-secondary text-light rounded rounded-pill"
                    @click="searchDoctor"
                  >
                    Search
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <h1 class="h3 my-3">Doctor List</h1>

        <div class="row mb-4" v-if="noData">
          <div class="col-12 fs-5">no record found!</div>
        </div>

        <div v-else>
          <div class="row mb-4" v-for="row in rows" :key="'row' + row">
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
      keyword: this.$store.state.keyword,
      isLoading: false,
      isError: false,
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
    noData() {
      return this.doctors.length === 0;
    },
  },
  methods: {
    doctorsInRow(row) {
      return this.doctors.slice((row - 1) * this.columns, row * this.columns);
    },
    placeHolederInRow(row) {
      return this.columns - this.doctorsInRow(row).length;
    },
    searchDoctor() {
      this.isLoading = true;

      // console.log(this.$store);
      this.$store.dispatch("setLastKeyword", this.keyword);

      axios
        .get(`/api/doctors?keyword=${this.keyword}`)
        .then((result) => {
          this.doctors = result.data.data;
          this.isLoading = false;
          // this.doctors.push({ name: "X", email: "x" });
        })
        .catch((err) => {
          if (err.response && err.response.status) {
            this.isError = true;
          }
        });
    },
  },
  created() {
    this.searchDoctor();
  },
};
</script>
