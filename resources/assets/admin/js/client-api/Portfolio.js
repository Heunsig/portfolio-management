import { get } from './request'

class Portfolio {
  constructor (request) {
    this.request = request
  }

  all () {
    const url = `/portfolios`

    return {
      get: get(this.request, url)
    }
  }

  findById (id) {
    const url = `/portfolios/${id}`

    return {
      get: get(this.request, url)
    }
  }
}

export default Portfolio