export default {
  validDuration() {
    const current = new Date().getTime()
    // console.log(`current time:: ${new Date().toString()}`)

    const startTimeString = new Date(import.meta.env.VITE_START_TIME)
    const startTime = startTimeString.getTime()
    // console.log(`start time::${startTimeString.toString()}`)

    const endTimeString = new Date(import.meta.env.VITE_END_TIME)
    const endTime = endTimeString.getTime()
    // console.log(`end time::${endTimeString.toString()}`)

    // console.log(`coming soon::${startTime > current}`);
    // console.log(`end page::${endTime < current}`);

    if (startTime > current) {
      return 'before'
    }
    if (endTime < current) {
      return 'after'
    }
    return 'valid'
  },
}
