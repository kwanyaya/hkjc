import { countryPhone } from '@/constants/country-phone'

export default {
  // validString(){
  //     let reg = /^([a-zA-Z]+\s)*[a-zA-Z]+$/;
  // },
  validttest(field) {
    console.log(`validation::${field}`)
    // let rex = /[^\u4e00-\u9fa5]$/;
    const rex = /^[ A-Za-z\u3000-\u303F\u3400-\u4DBF\u4E00-\u9FFF]+$/

    return rex.test(field)
    // let temp_result = rex.test(field)
    // console.log(temp_result)
  },

  validChinese(field) {
    const rex = /^[\u3000-\u303F\u3400-\u4DBF\u4E00-\u9FFF]+$/
    return rex.test(field)
  },
  validAlphbet(field) {
    const rex = /^([a-zA-Z]+\s)*[a-zA-Z]+$/
    return rex.test(field)
  },
  validName(field) {
    return this.validChinese(field) || this.validAlphbet(field)
  },
  validNumber(field) {
    return !isNaN(field)
  },
  validPhoneLength(countryCode, field) {
    if (!Object.prototype.hasOwnProperty.call(countryPhone, countryCode)) {
      console.log('your country-phone does not contain this country code')
      return true
    }
    return field.length == countryPhone[countryCode].strLen
  },
  validEmail(field) {
    const rex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
    return rex.test(field)
  },
  validDate(field) {
    return new Date(field) !== 'Invalid Date' && !isNaN(new Date(field))
    // return (new Date(field) !== "Invalid Date");
  },
}
