function deleteComment(id) {
  $.ajax({
    url: '/user/service/deleteComment/' + id,
    method: 'GET',
  }).done(function () {
    $("#"+id).hide()
  })
}
