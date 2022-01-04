<template>
  <div class="col-xl-3 col-md-6 mb-4">
    <div :class="'card border-left-' + type + ' shadow h-100 py-2'">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div
              :class="
                'text-xs font-weight-bold text-' + type + ' text-uppercase mb-1'
              "
            >
              {{ title }}
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              {{ value }}
            </div>
          </div>
          <div class="col-auto">
            <i :class="'fa' + icon + 'fa-2x text-gray-300'"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    type: { type: String, default: "primary" },
    title: { type: String, required: true },
    value: { type: String, required: true },
    icon: { type: String, default: "s fa-users" },
  },
};
</script>