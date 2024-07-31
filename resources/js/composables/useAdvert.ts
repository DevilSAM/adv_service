import request from '@/utils/request'
import { Ref, ref } from 'vue'
import { Advert } from "@/models/Advert";

export const useAdvert = () => {

  function getAdvertsList (params = {}) {
    return request({
      url: '/api/adverts',
      method: 'get',
      params
    })
  }

  function getAdvert (id: number, params = {}) {
    return request({
      url: `/api/adverts/${id}`,
      method: 'get',
      params
    })
  }

  function createAdvert(data: Advert) {
    return request({
      url: '/api/adverts',
      method: 'post',
      data
    })
  }


  const model = ref(new Advert()) as Ref<Advert>

  return {
    getAdvertsList,
    getAdvert,
    createAdvert,
    model
  }
}
