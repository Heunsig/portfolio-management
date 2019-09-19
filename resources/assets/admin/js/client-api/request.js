import { generateOnlyQuery } from './helpers/url'

export function get (axios, url) {
  return function (only=[]) {
    return new Promise((resolve, reject) => {
      axios.get(url, { params: {
        only: generateOnlyQuery(only)
      }}).then(res => {
        resolve(res.data)
      }).catch(error => {
        if (error.response) {
          let myWindow = window.open('', 'MsgWindow', "width=800,height=350")
          myWindow.document.write(error.response.data)
          // The request was made and the server responded with a status code
          // that falls out of the range of 2xx
          console.log(error.response.data);
          console.log(error.response.status);
          console.log(error.response.headers);
        } else if (error.request) {
          // The request was made but no response was received
          // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
          // http.ClientRequest in node.js
          console.log(error.request);
        } else {
          // Something happened in setting up the request that triggered an Error
          console.log('Error', error.message);
        }

        console.log(error.config);
        reject(err)
      })
    })
  }
}