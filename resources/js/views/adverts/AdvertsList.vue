<template>
  <div class="common-layout">
    <el-container>
      <el-main>
        <el-table
            v-loading="loading"
            ref="table"
            :data="list"
            fit
            class="main-table pt-4"
            @sort-change="onSort" >
          <el-table-column sortable="custom" prop="id" label="ID" width="80" align="center">
            <template #default="scope">
              <router-link :to="{name: 'AdvertCard', params: {id: scope.row.id}}">
                <h3>{{ scope.row.id }}</h3>
              </router-link>
            </template>
          </el-table-column>
          <el-table-column prop="title" label="Название">
            <template #default="scope">
              <h4>{{ scope.row.title }}</h4>
            </template>
          </el-table-column>
<!--          <el-table-column prop="description" label="Описание">-->
<!--            <template #default="scope">-->
<!--              <h6>{{ scope.row.description }}</h6>-->
<!--            </template>-->
<!--          </el-table-column>-->
          <el-table-column sortable="custom" prop="price" label="Цена" width="120">
            <template #default="scope">
              <h6>{{ scope.row.price }} &#8381;</h6>
            </template>
          </el-table-column>
          <el-table-column prop="image" label="Фото" align="center">
            <template #default="scope">
<!--              <el-carousel-->
<!--                :arrow="scope.row.images?.length > 1 ? 'hover' : 'never'"-->
<!--                indicator-position="none"-->
<!--                :autoplay="false"-->
<!--                height="100px">-->
<!--                <el-carousel-item v-for="image in scope.row.images" :key="image">-->
<!--                  <el-image :src="image" style="height:100px" fit="fill" />-->
<!--                </el-carousel-item>-->
<!--              </el-carousel>-->
              <el-image :src="getImageSrc(scope.row.image)" style="height:100px" fit="contain">
                <template #error>
                  <el-image src="/assets/images/no-img.png" style="height:100px" fit="contain" />
                </template>
              </el-image>
            </template>
          </el-table-column>
        </el-table>

        <pagination
            v-show="query.total>0"
            v-model:limit="query.perPage"
            v-model:page="query.page"
            :total="query.total"
            class="pt-4"
            @pagination="fetchData()" />

      </el-main>
    </el-container>
  </div>
</template>

<script setup lang="ts">
import {ref, onMounted} from "vue"
import { useAdvert } from "@/composables/useAdvert"
import Pagination from '@/components/Pagination/index.vue'
import {TableOptions} from '@/utils/settings'

// действия при загрузке компонента
onMounted(async () => {
  fetchData()
})

const loading = ref(false)
const { getAdvertsList } = useAdvert()
const options = ref(new TableOptions())

const list = ref([])
const query = ref({
  total: 0,
  page: 1,
  perPage: 10,
  sort_column: 'id',
  sort_direction: 'ASC',
})

const fetchData = (toFirstPage = false, allPages = false) => {
  loading.value = true
  if (toFirstPage) {
    query.value.page = 1
  }
  const data = {
    ...query.value,
  }
  return getAdvertsList(data).then(({ data }) => {
    console.log(data)
    list.value = data.data
    query.value.total = data.meta.total
  }).finally(() => {
    loading.value = false
  })
}

const onSort = (col) => {
  query.value.sort_column = col.prop
  query.value.sort_direction = col.order === 'descending' ? 'DESC' : 'ASC'
  fetchData()
}

const getImageSrc = val => val ?? '/assets/images/no-img.png'


</script>

<style scoped>
.header-title {
  background: linear-gradient(to right, #fff 0%, gainsboro 50%, #fff 100%);
}
.el-image__error {
  padding-left: 1rem;
  padding-right: 1rem;
}
</style>

