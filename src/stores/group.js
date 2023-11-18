import { ref } from 'vue'

export const useGroup = () => {
  const group = ref('')
  const offer = ref('')

  const routerList = {
    1: 1,
    2: 2,
    3: 3,

    4: 4,
    5: 5,
    6: 6,
    7: 7,

    8: 8,
    9: 9,
    public: 'public',
  }

  const groupList = {
    1: 1,
    2: 3,
    3: 4,

    4: 2,
    5: 2,
    6: 2,
    7: 2,

    8: 5,
    9: 5,
    public: 'public',
  }

  const offerList = {
    1: 'bag',
    2: 'freeAdmission',
    3: 'beer',
    4: 'coupon',
    5: 'couponAndFreeAdmission',
    public: 'public',
  }
  const adater = (_group) => {
    // return offerList[groupList[group]]
    return groupList[_group]
  }

  const SetUser = async (_group) => {
    group.value = routerList[_group]
    offer.value = adater(_group)
  }

  const GetGroup = () => {
    return group.value
  }
  const GetOffer = () => {
    return offer.value
  }

  return {
    SetUser,
    GetGroup,
    GetOffer,
  }
}
