import { useRoute } from 'vue-router'

/**
 * Вспомогательные функции для формы
 */
export const useForm = () => {
  const route = useRoute()
  return {
    isUpdate: () => route.params.id !== undefined,
  }
}
