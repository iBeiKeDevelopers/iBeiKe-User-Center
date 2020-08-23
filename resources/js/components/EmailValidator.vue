<template>
  <div class="col-12 input-group">
    <div class="input-group-prepend">
      <span class="input-group-text">
        <a-icon type="mail" />
      </span>
    </div>

    <input
      id="email"
      type="email"
      :placeholder="placeholder"
      :class="{'form-control': true, 'is-invalid is-warn' : invalid}"
      name="email"
      v-model="email"
      required
      autocomplete="email"
    />

    <span class="invalid-feedback text-warning-dark" role="alert">
      <strong>{{ message }}</strong>
    </span>
  </div>
</template>

<script>
export default {
  props: ["oldemail", "placeholder"],
  data: () => {
    return {
      invalid: false,
      message: "",
      email: "",
    };
  },
  mounted() {
    this.email = this.oldemail;
  },
  watch: {
    email: {
      handler: function (val) {
        console.log("Tick", this.invalid);
        if (!/^\w+@\w+.\S+$/.exec(val)) {
          return;
        }

        if (!/@xs.ustb.edu.cn$/.exec(val)) {
          console.log(val, this.invalid);
          this.message = "注意：如果您是学生，你的邮箱以 xs.ustb.edu.cn 结尾。";
          this.invalid = true;
          return;
        }

        if (/^[0-9]+@xs.ustb.edu.cn/.exec(val)) {
          this.message =
            "提示：研究生学号格式为字母 + 数字，本科同学请忽略此提示。";
          this.invalid = true;
          return;
        }

        this.invalid = false;
      },
    },
  },
};
</script>

<style>
.form-control.is-warn {
  border-color: #fa8521 !important;
  background-image: none !important;
}

.text-warning-dark {
  color: #fa8521 !important;
}
</style>
