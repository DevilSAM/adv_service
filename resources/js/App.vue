<template>
  <div class="common-layout container">
    <el-container class="vh-100">
      <el-header class="px-0">
        <navbar-component v-if="!route.meta?.withoutNavbar"></navbar-component>
      </el-header>
      <el-main class="main">
        <router-view></router-view>
      </el-main>
      <el-footer class="px-0" height="100px">
        <footer-component></footer-component>
      </el-footer>
    </el-container>
  </div>
</template>

<script lang="ts" setup>
import NavbarComponent from '@/components/NavbarComponent.vue'
import FooterComponent from '@/components/FooterComponent.vue'
import {defineComponent, watch, computed} from 'vue'
import { useRouter, useRoute } from "vue-router"



const router = useRouter()
const route = useRoute()
const x = computed(() => {
  console.log(route.meta)
  return route.meta
})

</script>

<style scoped lang="scss">
.vh-100 {
  min-height: 100vh;
}
.container {
  height: 100vh;
  padding-left: 0;
  padding-right: 0;

  .main {
    background:  #FFFFFF;
  }
}
</style>
