import { BaseModel } from 'sjs-base-model'

export class TableOptions extends BaseModel {
  perPage = 20
  pinned = true
  sort_direction = 'ASC'
  sort_column = 'id'
  columns: string[] = []

  constructor (data?: Partial<TableOptions>) {
    super({ expand: true })
    this.update(data)
  }
}

// finally Settings

export class Settings extends BaseModel {
  tableOptions: {
    [tableKey: string]: TableOptions
  } = {}

  constructor (data?: Partial<Settings>) {
    super()
    if (data === null) {
      return
    }
    this.update(data)
  }
}
