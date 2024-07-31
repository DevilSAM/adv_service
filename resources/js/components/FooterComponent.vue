<template>
  <div class="footer d-flex justify-content-center align-items-center">
    <a href="https://t.me/devilsam" target="_blank" class="mx-4">
      <el-button type="primary" size="large" >
        <font-awesome-icon icon="fa-solid fa-paper-plane" size="2x"/>
      </el-button>
    </a>
    <a href="https://www.instagram.com/devilsam84/" target="_blank" class="mx-4">
      <el-button type="warning" size="large" >
        <font-awesome-icon icon="fa-brands fa-instagram" size="2x"/>
      </el-button>
    </a>
    <a href="https://twitter.com/DevilSAM84" target="_blank" class="mx-4">
      <el-button type="primary" size="large" >
        <font-awesome-icon icon="fa-brands fa-twitter" size="2x"/>
      </el-button>
    </a>

  </div>
</template>

<script>
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faPaperPlane } from '@fortawesome/free-solid-svg-icons'
import { faTwitter, faInstagram } from '@fortawesome/free-brands-svg-icons'
library.add(faPaperPlane, faTwitter, faInstagram)
export default {
  components: {FontAwesomeIcon},
  name: "FooterComponent"
}
</script>

<style scoped>
.footer {
  height: 100%;
  background: linear-gradient(to bottom, rgba(255,255,255, 1) 0%, rgba(255,255,255, 0) 100%);
}
</style>
