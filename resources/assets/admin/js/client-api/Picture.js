import { get } from './request'

class Picture {
  constructor (request) {
    this.request = request
  }

  findById (id) {
    const url = `/pictureRooms/${id}`
    return {
      get: get(this.request, url)
    }
  }

  findByCode (code) {
    const url = `/pictureRooms/code/${code}`
    return {
      get: get(this.request, url)
    }
  }

}

export default Picture