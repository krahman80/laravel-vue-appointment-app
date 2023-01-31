<template>
  <div class="row">
    <div class="col-md-8">
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
          <h3>{{ doctor.name }}</h3>
          <hr>
          <article>
            {{ doctor.email }}
          </article>
        </div>

      </div>
    </div>
    <div class="col-md-4">
      <div class="card">

        <div class="card-body">
          <h5 class="card-title">
            xxx
          </h5>
          <vc-calendar
            :attributes="attributes"
            @dayclick="onClickDay"
          ></vc-calendar>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      doctor: null,
      schedules: null,
      isLoading: false,
      attributes: [
        // {
        //   key: 1,
        //   highlight: true,
        //   dates: new Date("2023-01-31"),
        // },
      ],
      timeslot: [],
    };
  },
  created() {
    // console.log(this.$route.params.id);
    this.isLoading = true;
    // axios.get(`/api/doctors/${this.$route.params.id}`).then((result) => {
    //   this.doctor = result.data.data;
    //   this.isLoading = false;
    // });

    axios
      .all([
        axios.get(`/api/doctors/${this.$route.params.id}`),
        axios.get(`/api/doctor-schedules/${this.$route.params.id}`),
      ])
      .then(
        axios.spread((first, second) => {
          this.doctor = first.data.data;
          // this.schedules = JSON.parse(JSON.stringify(second.data.data));
          this.schedules = second.data.data;
          this.schedules.map((data, index) => {
            // return { dates: date, hightlight: true };
            this.attributes.push({
              key: index + 1,
              dates: new Date(data.date),
              highlight: {
                color: "blue",
                fillMode: "outline",
              },
            });
          });
          this.isLoading = false;
        })
      )
      .catch((error) => console.log(`error on : ${error}`));
  },
  methods: {
    onClickDay(day) {
      // const idx = this.days.findIndex((d) => d.id === day.id);
      console.log(day.date);
      //make axios request
    },
  },
};
</script>