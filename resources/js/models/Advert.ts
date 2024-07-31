import { AdvertDto } from '@/types/generated'
import { BaseModel } from 'sjs-base-model'

export class Advert extends BaseModel implements AdvertDto {
  id: any | number
  // eslint-disable-next-line @typescript-eslint/ban-ts-comment
  // @ts-ignore
  title: string
  // eslint-disable-next-line @typescript-eslint/ban-ts-comment
  // @ts-ignore
  description: string | null
  // @ts-ignore
  image: string | null
  images: any
  // eslint-disable-next-line @typescript-eslint/ban-ts-comment
  // @ts-ignore
  price: number

  constructor(data = {}) {
    super({ expand: true })

    this.update(data)
  }

  update(data: Partial<Advert>): void {
    super.update(data)
  }

  toRequestForm() {
    return this.clone()
  }
}
