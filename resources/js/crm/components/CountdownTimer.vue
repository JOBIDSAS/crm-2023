<template>
  <div style="color:#111D5E">
    <p class="m-0" :class="{'text-danger':total<=0}">
      <strong>{{minutes}}</strong>
      <strong>:</strong>
      <strong>{{seconds}}</strong>
    </p>
  </div>
</template>

<script>
export default {
    props: {
      time: {
        type: Number,
        default: 0
      }
    },
    data () {
        return {
          total: '',
          minutes: '--',
          seconds: '--',
          interval: 0
        }
    },
    mounted () {
      this.total = parseInt(this.time, 10)
      this.$bus.$on("Timer/start", () => {
       this.startTimer()
      })
      this.$bus.$on("Timer/stop", () => {
        clearInterval(this.interval)
        this.$bus.$emit("Timer/result", this.total);
      })
    },
    methods: {
      startTimer (){
        this.interval = setInterval(() => {
          this.tick()
        }, 1000)
      },

      str_pad_left (string, pad, length) {
        return (new Array(length+1).join(pad)+string).slice(-length)
      },

      tick () {
        var minutes = Math.floor(this.total / 60)
        var seconds = this.total - minutes * 60
        this.minutes = this.str_pad_left(minutes, '0', 2)
        this.seconds = this.str_pad_left(seconds, '0', 2)
        /* if (this.total <= 0) {
          clearInterval(this.interval)
        } */
        this.total -= 1
      }
    }
}
</script>

<style>

</style>