<template>
  <div class="row">
    <div class="col-md-8">
      <div class="card">

        <div
          class="card-body"
          v-if="!loading"
        >
          <h3>{{ doctor.name }}</h3>
          <hr>
          <article>
            {{ doctor.email }}
          </article>
        </div>
        <div
          class="card-body"
          v-else
        >
          loading ...
        </div>

      </div>
    </div>
    <div class="col-md-4">xxx</div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      doctor: null,
      loading: false,
    };
  },
  created() {
    // console.log(this.$route.params.id);
    this.loading = true;
    axios.get(`/api/doctors/${this.$route.params.id}`).then((result) => {
      this.doctor = result.data.data;
      this.loading = false;
    });
  },
};
</script>