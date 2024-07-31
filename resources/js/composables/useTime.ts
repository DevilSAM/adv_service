/**
 * Вспомогательные функции для времени
 */
export const useTime = () => {
  const getFormattedTime = (val: number|null) => {
    if (val) {
      const hours = Math.floor(val / 60 / 60);
      const minutes = Math.floor(val / 60) - (hours * 60);
      const seconds = val % 60;
      return `${hours}ч ${minutes}мин ${seconds}с`
    }
    return '-'
  }

  const getDateInLocaleFormat = (dateInString: string) => {
    if (dateInString) {
      const d = new Date(dateInString)

      return ('0' + d.getDate()).slice(-2) +
        '.' + ('0' + (d.getMonth() + 1)).slice(-2) +
        '.' + d.getFullYear()
    }
    return ''
  }

  const getDateTimeInLocaleFormat = (dateInString: string) => {
    if (dateInString) {
      const d = new Date(dateInString)

      return getDateInLocaleFormat(dateInString) + ' ' +
        ('0' + d.getHours()).slice(-2) + ':' + ('0' + d.getMinutes()).slice(-2) + ':' + ('0' + d.getSeconds()).slice(-2)
    }
    return ''
  }

  const getTimeInLocaleFormat = (dateInString: string) => {
    if (dateInString) {
      const d = new Date(dateInString)

      return ('0' + d.getHours()).slice(-2) + ':' + ('0' + d.getMinutes()).slice(-2)
    }
    return ''
  }


  return {getFormattedTime,getDateInLocaleFormat, getDateTimeInLocaleFormat, getTimeInLocaleFormat}
}
