import axios from 'axios'
import Content from './Content'
import Portfolio from './Portfolio'
import Picture from './Picture'
import Icon from './Icon'
import Category from './Category'

class Model {
    constructor (baseURL, key) {
      this.request = axios.create({
        baseURL: baseURL,
        params: {
          key: key
        }
      })
    }

    contents () {
      return new Content(this.request)
    }

    portfolios () {
      return new Portfolio(this.request)
    }

    pictures () {
      return new Picture(this.request)
    }

    icons () {
      return new Icon(this.request)
    }

    categories () {
      return new Category(this.request)
    }
}

export default Model