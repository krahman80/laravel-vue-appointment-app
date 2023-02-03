<template>
  <div class="row">
    <div class="col-lg-9 col-md-12 mb-2">
      <div class="card">

        <div
          class="card-body"
          v-if="isLoading"
        >
          data is loading ...
        </div>
        <div
          class="card-body"
          v-else
        >
          <h4 class="card-title text-center">{{ doctor.name }}</h4>
          <h6 class="card-subtitle mb-2 text-muted text-center">{{ doctor.email }}</h6>
          <hr>
          <div class="card-text p-3">
            <!-- <div class="alert alert-dismissible alert-success">
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
              ></button>
              <h4 class="alert-heading">Success!</h4>
              <p class="mb-0">Best check yo self, you're not looking too good. <a
                  href="#"
                  class="alert-link"
                >cek your appointment status</a>.</p>
            </div> -->

            <div class="row">
              <div class="col-lg-6 col-md-12 d-flex justify-content-center">
                <div class="my-2">
                  <h5 class="text-muted mb-3 text-center">Calendar</h5>
                  <vc-calendar
                    :attributes="attributes"
                    :min-date="new Date()"
                    @dayclick="onClickDay"
                  ></vc-calendar>
                </div>

              </div>
              <div class="col-lg-6 col-md-12 d-flex justify-content-center">
                <div class="my-2 text-center">
                  <h5 class="text-muted mb-3">Available Schedule</h5>
                  <div class="form-group mb-3">

                    <div v-if="timeSlot.length == 0">
                      <p
                        v-if="status==404"
                        class="text-success"
                      >
                        Schedule not available!
                      </p>
                    </div>
                    <div v-else>
                      <div
                        v-for="(timeItem, index) in timeSlot"
                        :key="'ts'+index"
                      >
                        <doctor-show-time-item v-bind="timeItem"></doctor-show-time-item>
                      </div>

                    </div>

                  </div>
                  <div class="form-group">
                    <button
                      class="btn btn-secondary btn-sm w-auto"
                      :disabled="timeSlot.length == 0"
                    >Submit</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="row mt-4">
              <div class="col col-10 mx-auto">
                
              </div>

            </div> -->

          </div>

        </div>

      </div>
    </div>
    <div class="col-lg-3 col-md-12 mb-2">
      xxx

    </div>
  </div>
</template>

<script>
import DoctorShowTimeItem from "./DoctorShowTimeItem.vue";

export default {
  components: {
    DoctorShowTimeItem,
  },
  data() {
    return {
      doctor: null,
      schedules: null,
      isLoading: false,
      timeSlot: [],
      status: null,
    };
  },
  created() {
    // console.log(this.$route.params.id);
    this.isLoading = true;
    axios
      .all([
        axios.get(`/api/doctors/${this.$route.params.id}`),
        axios.get(`/api/doctors/${this.$route.params.id}/schedule`),
      ])
      .then(
        axios.spread((first, second) => {
          this.doctor = first.data.data;
          this.schedules = second.data.data;
          this.isLoading = false;
        })
      )
      .catch((error) => {
        if (error.response.status === 404) {
          // what the hell do i do here?
          this.$router.push({ name: "404" });
        }
      });
  },
  methods: {
    onClickDay(day) {
      this.timeSlot = [];
      this.status = null;
      const dayString = this.convertDate(day.date);
      const url = `/api/doctors/${this.$route.params.id}/schedule/${dayString}`;
      //make axios request
      axios
        .get(url)
        .then((response) => (this.timeSlot = response.data.data))
        .catch((error) => (this.status = error.response.status));
    },
    convertDate(date) {
      var yyyy = date.getFullYear().toString();
      var mm = (date.getMonth() + 1).toString();
      var dd = date.getDate().toString();

      var mmChars = mm.split("");
      var ddChars = dd.split("");

      return (
        yyyy +
        "-" +
        (mmChars[1] ? mm : "0" + mmChars[0]) +
        "-" +
        (ddChars[1] ? dd : "0" + ddChars[0])
      );
    },
  },
  computed: {
    attributes() {
      if (this.schedules != null) {
        return [
          {
            key: "today",
            highlight: {
              color: "blue",
              fillMode: "light",
            },
            dates: new Date(),
          },
          {
            dot: true,
            highlight: {
              color: "green",
              fillMode: "light",
            },
            dates: [...this.schedules.map((obj) => new Date(obj.date))],
          },
        ];
      }
    },
  },
};
</script>