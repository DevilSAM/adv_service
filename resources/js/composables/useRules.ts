export const advertRules = {
  title: [
    {required: true, message: 'Введите название проекта', trigger: ['blur', 'change']},
    {max: 200, message: 'Не более 200 символов', trigger: ['blur', 'change']}
  ],
  description: [
    {required: true, message: 'Введите описание проекта', trigger: ['blur', 'change']},
    {max: 1000, message: 'Не более 1000 символов', trigger: ['blur', 'change']}
  ],
  price: [
    {type: 'number', message: 'Должно быть число', trigger: ['blur', 'change']},
  ],
}
