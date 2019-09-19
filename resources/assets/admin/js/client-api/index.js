import Model from './Model'

class CatchaPortfolio extends Model{
  constructor (baseURL, key) {
    super(baseURL, key)
  }

  // generateURL (id, only) {
  //   return (id ? `/${id}` : '') + `?key=${this.key}` + (only.length > 0 ? `&only=${only.join(',')}` : '')
  // }

  // getContents (id, only=[]) {
  //   return new Promise((resolve, reject) => {
  //     this.axios.get('/contents' + this.generateURL(id, only)).then(res => {
  //       resolve(res.data)
  //     }).catch(err => {
  //       reject(err)
  //     })
  //   })
  // }

  // getPortfolios (id, only=[]) {
  //   return new Promise((resolve, reject) => {
  //     this.axios.get('/portfolios' + this.generateURL(id, only)).then(res => {
  //       resolve(res.data)
  //     }).catch(err => {
  //       reject(err)
  //     })
  //   })
  // }

  // pictures () {
  //   return new Picture(this.axios, this.key)
  // }

  // getPictures (id, only=[]) {
  //   console.log('hello')
  //   return test
  //   // return new Promise((resolve, reject) => {
  //   //   this.axios.get('/pictureRooms' + this.generateURL(id, only)).then(res => {
  //   //     resolve(res.data)
  //   //   }).catch(err => {
  //   //     reject(err)
  //   //   })
  //   // })
  // }
}

window.CatchaPortfolio = CatchaPortfolio