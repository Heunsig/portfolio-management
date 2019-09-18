class CatchaPortfolio {
  constructor (baseUrl, key) {
    this.baseURL = baseUrl
    this.key = key

    this.axios = axios.create({
      baseURL: this.baseURL
    })
  }

  generateURL (id, only) {
    return (id ? `/${id}` : '') + `?key=${this.key}` + (only.length > 0 ? `&only=${only.join(',')}` : '')
  }

  getContents (id, only=[]) {
    return new Promise((resolve, reject) => {
      this.axios.get('/contents' + this.generateURL(id, only)).then(res => {
        resolve(res.data)
      }).catch(err => {
        reject(err)
      })
    })
  }

  getPortfolios (id, only=[]) {
    return new Promise((resolve, reject) => {
      this.axios.get('/portfolios' + this.generateURL(id, only)).then(res => {
        resolve(res.data)
      }).catch(err => {
        reject(err)
      })
    })
  }

  getPictures (id, only=[]) {
    return new Promise((resolve, reject) => {
      this.axios.get('/pictureRooms' + this.generateURL(id, only)).then(res => {
        resolve(res.data)
      }).catch(err => {
        reject(err)
      })
    })
  }

}