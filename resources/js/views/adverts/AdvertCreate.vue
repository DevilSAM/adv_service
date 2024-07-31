<template>
  <div class="common-layout">
    <el-container>
      <el-main>

        <el-card shadow="always" class="box-card mt-5 text-center mx-auto w-50">
          <template #header>
            <div class="card-header">
              <h2 v-if="isUpdate()">{{ model.title }}</h2>
              <h2 v-else>Создать объявление</h2>
            </div>
          </template>

          <el-form
            :model="model"
            ref="formRef"
            :rules="rules"
            label-width="120px">
            <el-form-item label="Название" prop="title">
              <el-input v-model="model.title" />
            </el-form-item>
            <el-form-item label="Описание" prop="description">
              <el-input v-model="model.description" type="textarea" :rows="4" />
            </el-form-item>

            <el-form-item
                v-for="(img, index) in imagesArray.images"
                :key="img.key"
                :label="`Фото ${index+1}`"
                :prop="'images.' + index + '.value'">
              <el-input v-model="img.value" />
              <el-button class="mt-2" @click.prevent="removeImg(img)">
                Удалить
              </el-button>
            </el-form-item>
            <el-form-item>
              <el-button
                v-if="imagesArray.images?.length < maxImgsLinksAllowed"
                @click="addImage">
                Добавить фото
              </el-button>
            </el-form-item>

            <el-form-item label="Цена" prop="price">
              <el-input-number v-model="model.price" :step="100" />
            </el-form-item>
            <el-form-item>
              <el-button
                type="primary"
                :disabled="loading"
                @submit="handleSubmit(formRef)"
                @click="handleSubmit(formRef)"
              >Сохранить</el-button>
            </el-form-item>
          </el-form>
        </el-card>

      </el-main>
    </el-container>
  </div>
</template>

<script setup lang="ts">
import {ref, computed, reactive, Ref, onMounted} from "vue"
import {useRoute, useRouter} from 'vue-router'
import { type FormInstance, ElMessage } from 'element-plus'
import { useAdvert } from "@/composables/useAdvert"
import { useForm } from "@/composables/Form"
import {Advert} from "@/models/Advert"
import {advertRules} from '@/composables/useRules'

const maxImgsLinksAllowed = 3
const route = useRoute()
const router = useRouter()
const loading = ref(false)
const formRef = ref<FormInstance>()
const { createAdvert } = useAdvert()
const { isUpdate } = useForm()

// правила для валидации формы
const rules = ref(advertRules)
const advertNumber = computed(() => model.value.id ? `Объявление № ${model.value.id}` : 'Новое')
const model = ref(new Advert()) as Ref<Advert>


const imagesArray = reactive<{
  images: ImageItem[]
}>({
  images: [
    {
      key: 1,
      value: '',
    },
  ],
})
interface ImageItem {
  key: number
  value: string
}

onMounted(()=>{
  model.value.images = []
})

const handleSubmit = (formEl: FormInstance | undefined) => {
  if (!formEl) return
  formEl.validate(async (valid) => {
    if (!valid) {
      return false
    }
    if (imagesArray.images.length) {
      model.value.images = imagesArray.images.filter(img => img.value).map(img => img.value)
    }
    try {
      loading.value = true
      const { data } = await createAdvert(model.value)
      console.log('DATA: ', data)
      ElMessage.success({ message: 'Данные сохранены' })
      await router.push({ name: 'AdvertCard', params: { id: data.id } })

    } catch (e) {
      ElMessage.error({ message: e.response?.data?.message })
      console.log(e)

    } finally {
      loading.value = false
    }

  }).catch(() => {
    ElMessage.error({ message: 'Проверьте правильность заполнения полей!' })
  })
}

const dynamicValidateForm = reactive<{
  domains: String[]
  email: string
}>({
  domains: [''],
  email: '',
})

const removeImg = (item: ImageItem) => {
  const index = imagesArray.images.indexOf(item)
  if (index !== -1) {
    imagesArray.images.splice(index, 1)
  }
}

const addImage = () => {
  imagesArray.images.push({
    key: Date.now(),
    value: '',
  })
}


</script>

<style scoped>
.header-title {
  background: linear-gradient(to right, #fff 0%, gainsboro 50%, #fff 100%);
}
</style>
<style>
.el-main {
  padding-top: 0;
}
</style>
