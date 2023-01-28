<template>
  <!-- <div class="col-lg-2 col-md-3 mb-4 mb-lg-0">
    <div class="card rounded shadow-sm border-0">
      <div class="card-body p-0">
        <div class="px-5 py-4 text-center card-img-top"><img
            src="http://placekitten.com/300/300"
            alt="..."
            width="100"
            class="bg-light rounded-circle mb-2 img-thumbnail d-block mx-auto"
          >
          <h5 class="text-dark mb-0">{{ name }}</h5>
          <p class="small text-muted mb-0">{{ description}} - {{ price }}</p>
        </div>
      </div>
    </div>
  </div> -->
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">{{ name }}</h5>
      <p class="card-text">{{ description }} - {{ price }}</p>
    </div>
  </div>

</template>
<script>
export default {
  props: {
    name: String,
    description: String,
    price: Number,
  },
};
</script>