import { get } from './request'

class Category {
  constructor (request) {
    this.request = request
  }

  all () {
    const url = `/categories`

    return { 
      get: get(this.request, url)
    }
  }

  findById (id) {
    const url = `/categories/${id}`

    return {
      get: get(this.request, url)
    }
  }

  findByName (name) {
    const url = `/categories/name/${name}`

    return {
      get: get(this.request, url)
    }
  }

  findByCode (code) {
    const url = `/categories/code/${code}`

    return {
      get: get(this.request, url)
    }
  }
}

export default Category