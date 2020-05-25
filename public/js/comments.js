function deleteComment(id) {
  $.ajax({
    url: '/user/service/deleteComment/' + id,
    method: 'GET',
  }).done(function () {
    console.log('supprimé')
    $("#"+id).hide()
  })
}
