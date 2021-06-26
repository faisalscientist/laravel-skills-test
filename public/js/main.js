$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
  },
})

$(document).ready(function () {
  // Calculate total sum
  calculateTotal()

  $(document).on('click', '#submitForm', function (e) {
    e.preventDefault()
    e.stopImmediatePropagation()
    var button = $(this)
    button.attr('disabled', true)
    button.css('cursor', 'not-allowed')
    setErrors()
    var formData = {
      productName: $('#productName').val(),
      quantityInStock: $('#quantityInStock').val(),
      pricePerItem: $('#pricePerItem').val(),
    }
    $.ajax({
      type: 'POST',
      url: '/',
      data: formData,
      dataType: 'json',
      success: function (data) {
        let totalSum = data.quantityInStock * data.pricePerItem
        var product = `<tr id="${data.productId}">
          <td>${data.productName}</td>
          <td>${data.quantityInStock}</td>
          <td>${data.pricePerItem}</td>
          <td>${data.dateAdded}</td>
          <td>${totalSum}</td>
          <td><button id="editProduct${data.productId}" class="editproductbtn btn btn-primary btn-sm"  data-toggle="modal" data-target="#editProduct">Edit</button></td>
        </tr>`
        $('#totalSum').html(+$('#totalSum').html() + totalSum)
        $('#productsTable').prepend(product)
        $('#productForm').trigger('reset')
        button.attr('disabled', false)
        button.css('cursor', 'pointer')
      },
      error: function (data) {
        const { errors } = data.responseJSON
        for (const key in errors) {
          const error = errors[key]
          $(`#${key}Error`).html(error[0])
        }
        button.attr('disabled', false)
        button.css('cursor', 'pointer')
      },
    })
  })

  $(document).on('click', '.editproductbtn', function (e) {
    var button = $(this)
    var productId = button.attr('id').split('editProduct')[1]
    $('#productsTable')
      .find('tr')
      .each(function (index, tr) {
        if (tr.getAttribute('id') === productId) {
          $('#editProductId').val(productId)
          $('#editProductName').val($(this).find('td')[0].innerHTML)
          $('#editQuantityInStock').val($(this).find('td')[1].innerHTML)
          $('#editPricePerItem').val($(this).find('td')[2].innerHTML)
          return
        }
      })
  })

  $(document).on('click', '#submitEditForm', function (e) {
    e.preventDefault()
    e.stopImmediatePropagation()
    var button = $(this)
    button.attr('disabled', true)
    button.css('cursor', 'not-allowed')
    setErrors()
    var formData = {
      productName: $('#editProductName').val(),
      quantityInStock: $('#editQuantityInStock').val(),
      pricePerItem: $('#editPricePerItem').val(),
    }
    $.ajax({
      type: 'PUT',
      url: `/${$('#editProductId').val()}`,
      data: formData,
      dataType: 'json',
      success: function (data) {
        let totalSum = data.quantityInStock * data.pricePerItem
        $('#productsTable')
          .find('tr')
          .each(function (index, tr) {
            if (tr.getAttribute('id') === $('#editProductId').val()) {
              console.log('23')
              $(this).find('td')[0].innerHTML = data.productName
              $(this).find('td')[1].innerHTML = data.quantityInStock
              $(this).find('td')[2].innerHTML = data.pricePerItem
              $(this).find('td')[4].innerHTML =
                data.quantityInStock * data.pricePerItem
              calculateTotal()
              return
            }
          })
        $('#editProductForm').trigger('reset')
        $('#editProduct').modal('hide')
        button.attr('disabled', false)
        button.css('cursor', 'pointer')
      },
      error: function (data) {
        const { errors } = data.responseJSON
        for (const key in errors) {
          const error = errors[key]
          $(`#edit${key}Error`).html(error[0])
        }
        button.attr('disabled', false)
        button.css('cursor', 'pointer')
      },
    })
  })
})

function setErrors() {
  $(`#productNameError`).html('')
  $(`#quantityInStockError`).html('')
  $(`#pricePerItemError`).html('')
}

function calculateTotal() {
  let total = 0
  $('#productsTable')
    .find('tr')
    .each(function () {
      total += +$(this).find('td')[4].innerHTML
    })
  $('#totalSum').html(total)
}
