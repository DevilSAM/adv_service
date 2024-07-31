<template>
  <el-menu
      :default-active="activeIndex"
      class="el-menu-demo"
      mode="horizontal"
      :ellipsis="false"
      @select="handleSelect"
  >
    <el-menu-item index="0">
      <el-image
          style="width: 50px"
          src="/assets/images/logo.png"
          alt="Element logo"
      />
    </el-menu-item>
    <div class="flex-grow" />
    <el-menu-item index="adverts">
      <router-link to="/adverts">Объявления</router-link>
    </el-menu-item>
    <el-menu-item index="AdvertCardCreate">
      <router-link :to="{ name: 'AdvertCardCreate' }">Создать Новое</router-link>
    </el-menu-item>
  </el-menu>
</template>
<script lang="ts" setup>
import { ref } from 'vue'
const activeIndex = ref('adverts')
</script>

<style scoped>

</style>
