<template>
  <div class="col-xl-3 col-md-6 mb-4">
    <a :href="link">
      <div :class="'card text-white bg-' + type">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="font-weight-bold text-white text-uppercase mb-1">
                {{ title }}
              </div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
            </div>
            <div class="col-auto">
              <i :class="'fa' + icon + ' fa-2x text-gray-300'"></i>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>
</template>
<script>
export default {
  props: {
    link: { type: String, default: "#" },
    type: { type: String, default: "primary" },
    title: { type: String, required: true },
    icon: { type: String, default: "s fa-users" },
  },
};
</script>