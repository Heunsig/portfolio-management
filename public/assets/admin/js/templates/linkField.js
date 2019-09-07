function LinkFieldTemplate (pn, nToC, cb) {
  var parentNode = $(pn)
  var nodeToCopy = clear($(nToC).eq(0).clone())
  // console.log(nodeToCopy)
  var nodeToCopyLength = parentNode.find(nToC).length
  var index = 0 
  if (nodeToCopyLength) {
    index = nodeToCopyLength
  }
  var callback = cb || null

  function clear (node) {
    node.find('select option:selected').removeAttr('selected')
    node.find('input[type="text"]').val('')

    // console.log('dd', node.find('select'))
    return node
  }



  return {
    add: () => {
      var copiedNode = nodeToCopy.clone()
      copiedNode.find('select').attr('name', `links[${index}][name]`)
      copiedNode.find('input[type="text"]').attr('name', `links[${index}][link]`)
      parentNode.append(copiedNode)
      index++

      if (callback) {
        callback()
      }
    }
  }
}