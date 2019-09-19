// export function generateURL (id, only) {
//   return (id ? `/${id}` : '') + `?` + (only.length > 0 ? `&only=${only.join(',')}` : '')
// }

export function generateOnlyQuery (only) {
  return only.join(',')
}