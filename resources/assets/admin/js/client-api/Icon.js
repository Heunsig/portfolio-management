import { get } from './request'

class Icon {
  constructor (request) {
    this.request = request
  }

  all () {
    const url = `/icons`

    return { 
      get: get(this.request, url)
    }
  }

  findById (id) {
    const url = `/icons/${id}`

    return {
      get: get(this.request, url)
    }
  }

  findByName (name) {
    const url = `/icons/name/${name}`

    return {
      get: get(this.request, url)
    }
  }

}

export default Icon