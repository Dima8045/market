import axios from "axios"

/*Generate coupon code*/
$('#generate-coupon-code').click(function () {
  axios.get(generateCouponCodeUrl)
    .then((response) => {
      $('#input-coupon-code').val(response.data.code)
    })
})

/*Check coupon type*/
$('.input-coupon-type select[name=type] ').change(function () {
  if ($("select option:selected").val() == 0) {
    $('input[name=amount]').attr('max', 100)
  } else {
    $('input[name=amount]').attr('max', '')
  }
})