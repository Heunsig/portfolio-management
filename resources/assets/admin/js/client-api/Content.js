import { get } from './request'

class Content {
  constructor (request) {
    this.request = request
  }

  all () {
    const url = `/contents`

    return {
      get: get(this.request, url)
    }
  }

  findById (id) {
    const url = `/contents/${id}`

    return {
      get: get(this.request, url)
    }
  }

}

export default Content