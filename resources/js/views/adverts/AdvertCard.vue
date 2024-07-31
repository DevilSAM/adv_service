<template>
  <div class="common-layout">
    <el-container>
      <el-main>
        <el-card v-loading="loading" shadow="always" class="box-card mt-5 text-center mx-auto w-50">
          <template #header>
            <div class="card-header">
              <h2>{{ model.title }}</h2>
            </div>
          </template>

          <div class="block text-center pb-4">
            <span>Фото товара</span>
            <el-carousel
              :arrow="model.images?.length > 1 ? 'hover' : 'never'"
              :interval="5000"
              height="300px">
              <el-carousel-item v-if="model.images" v-for="image in model.images" :key="image">
                <el-image :src="image" style="height:300px" fit="cover" />
              </el-carousel-item>
              <el-carousel-item v-else>
                <el-image :src="model.image" style="height:300px" fit="cover">
                  <template #error>
                    <el-image src="/assets/images/no-img.png" style="height:300px" fit="cover" />
                  </template>
                </el-image>
              </el-carousel-item>
            </el-carousel>
          </div>

          <div class="price-section">
            <span>Цена: </span>
            <span>{{ model.price }} &#8381;</span>
          </div>

          <div v-if="descrChecked && model.description" class="description">
            <el-row :gutter="10">
              <el-col :span="6" class="description-property">
                Описание:
              </el-col>
            </el-row>
            <el-row :gutter="10">
              <el-col :span="24" class="description-value">
                {{ model.description }}
              </el-col>
            </el-row>
          </div>

          <el-collapse v-model="activeNames" class="mt-4" >
            <el-collapse-item title="Запрос доп данных" name="additionalFields">
              <div>
                <el-checkbox v-model="descrChecked" label="Описание" size="large" border />
                <el-checkbox v-model="imagesChecked" label="Все фото" size="large" border />
              </div>
              <div class="mt-4">
                <el-button type="success" @click="getAdditionalData">Получить</el-button>
              </div>
            </el-collapse-item>
          </el-collapse>

        </el-card>

      </el-main>
    </el-container>
  </div>
</template>

<script setup lang="ts">
import {ref, computed, onMounted, Ref} from "vue"
import {useRoute, useRouter} from 'vue-router'
import { useAdvert } from "@/composables/useAdvert"
import { useForm } from "@/composables/Form"
import {Advert} from "@/models/Advert"
import {advertRules} from '@/composables/useRules'

const route = useRoute()
const router = useRouter()
const loading = ref(false)
const { getAdvert } = useAdvert()
const { isUpdate } = useForm()

const additionalFields = ref()
const descrChecked = ref(false)
const imagesChecked = ref(false)

// правила для валидации формы
const rules = ref(advertRules)
const model = ref(new Advert()) as Ref<Advert>
onMounted(async () => {
  try {
    loading.value = true
    const { data } = await getAdvert(+route.params.id)
    model.value.update(data)
  } catch (e) {
    console.log(e)
  } finally {
    loading.value = false
  }
})

const activeNames = ref([])

const getAdditionalData = async () => {
  try {
    const arr = []
    activeNames.value = []
    if (descrChecked.value) {
      arr.push('description')
    }
    if (imagesChecked.value) {
      arr.push('images')
    }
    const fields = arr.length ? {fields: arr} : {}
    loading.value = true
    const { data } = await getAdvert(+route.params.id, fields)
    model.value.update(data)
  } catch (e) {
    console.log(e)
  } finally {
    loading.value = false
  }
}

</script>

<style scoped lang="scss">
.header-title {
  background: linear-gradient(to right, #fff 0%, gainsboro 50%, #fff 100%);
}
.price-section {
  font-size: 2rem;
  font-weight: 700;
  color: #146c43;
}
.description {
  text-align: left;

  .description-property {
    font-size: 2rem;
    font-weight: bold;
  }

  .description-value {
    font-size: 1.7rem;
  }
}
</style>
