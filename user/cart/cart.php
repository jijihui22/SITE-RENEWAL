<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/attention_renewal/user/inc/header.php';

  $where = '';
  if(isset($_SESSION['UID'])){
      $where = "B.userid = '{$_SESSION['UID']}'";
  }


  $sql = "SELECT A.thumbnail, A.name, A.price_val, A.level, A.sale_end_date, A.date_val, B.cartid, B.total FROM class A JOIN cart B ON A.pid = B.pid WHERE $where";
  $result = $mysqli -> query($sql);
  while($rs = $result->fetch_object()){
      $rsc[]=$rs;
  }

  $sql2 = "SELECT A.coupon_name, B.ucid, A.coupon_price FROM coupons A JOIN user_coupons B ON A.cid = B.couponid  WHERE B.userid = '{$_SESSION['UID']}' AND B.use_max_date > now() AND A.status = '활성화' AND B.status = 1";
  $result2 = $mysqli -> query($sql2);
  while($rs2 = $result2 -> fetch_object()){
      $rsc2[]=$rs2;
  }

  // var_dump($rsc2);

?>

  <link rel="stylesheet" href="/attention_renewal/user/css/cart.css">

  <div class="cart_container d-flex justify-content-between">
    <div class="cart_list">
      <h2 class="tt_01 text-center">장바구니</h2>
      <table class="table">
        <tbody class="cart_area">
          <?php
          if(isset($rsc)){
              foreach($rsc as $item){
          ?>
          <tr class="d-flex justify-content-between align-items-center" data-id="<?= $item->cartid ?>">
            <td class="cart_product_img"><a href="#"><img src="<?= $item->thumbnail ?>" alt="Product"></a>
            </td>
            <td class="cart_product_name">
              <span class="tt_03"><?= $item->name ?></span>
              <div class="cart_sub_title d-flex justify-content-start">
                <span class="cart_level">
                  <?php if($item->level == 1){
                    echo '초급';
                  }else if($item->level == 2){
                    echo '중급';
                  }else{
                    echo '고급';
                  }?>
                </span>
                <span class="cart_line">|</span>
                <span class="cart_limit">
                  <?php if($item->sale_end_date == 0){
                    echo '무제한';
                  }else{
                    echo $item->date_val.'개월';
                  } ?>
                </span>
              </div>
            </td>
            <td class="cart_product_price text1 number"><span><?= $item->price_val ?></span></td>
            <td class="cart_product_cancel text-end"><button class="cart_item_del"><i class="bi bi-x-square"></i></button></td>
          </tr>
          <?php }} ?>
        </tbody>
      </table>
      <div class="cart_button d-flex justify-content-end">
        <button class="btn btn-primary">쇼핑 계속하기</button>
        <button class="btn btn-danger">초기화</button>
      </div>
    </div>
    <div class="coupon">
      <div class="coupon_list">
        <h3 class="tt_03">쿠폰 사용하기</h3>
        <form action="#" class="radius_medium">
          <select name="coupon" id="coupon" class="form-select">
            <option value="" disabled selected>쿠폰을 선택하세요</option>
            <?php
                if(isset($rsc2)){
                    foreach($rsc2 as $item){
            ?>
            <option value="<?= $item->ucid ?>" data-price="<?= $item->coupon_price ?>"><?= $item->coupon_name ?></option>
            <?php
                }}
            ?>
          </select>
        </form>
      </div>
      <div class="cart_total radius_medium">
        <ul>
          <li class="cart_choice text2 d-flex justify-content-between">
            <span>선택 강좌</span>
            <span class="subtotal"></span>
          </li>
          <li class="cart_sale text2 d-flex justify-content-between">
            <span>쿠폰 할인가</span>
            <span class="discount">0</span>
          </li>
          <li class="cart_price tt_03 d-flex justify-content-between">
            <span><strong>합계</strong></span>
            <span><strong class="grandtotal">0</strong></span>
          </li>
        </ul>
        <div class="cart_checkout text-center">
          <a href="checkout.html" class="btn btn-primary radius_large checkout-btn text2">구매하기</a>
        </div>
      </div>
    </div>
  </div>

  <script src="/attention_renewal/user/js/jquery.number.min.js"></script>
  <script>
    $('.number').number(true);
    $('.cart_area tbody tr').find('.quantity > span').click(function(){
        let item = $(this).closest('tr');
        let unitprice = Number(item.find('.price span').text());
        let count = Number(item.find('.qty-text').val());
        let itemtotal = unitprice * count;

        item.find('.total_price span').text(itemtotal);
        cartCalc();
    })

    function cartCalc(){
        let subtotal = 0;
        $('.cart_area tbody tr').each(function(){
            let unitprice = Number($(this).find('.price span').text());
            let count = Number($(this).find('.qty-text').val());
            let itemtotal = unitprice * count;

            subtotal+=itemtotal;

            $(this).find('.total_price span').text(itemtotal);
            console.log(unitprice, count, itemtotal);
            $(this).find('cart_item_del').click(function(){
                
            })
            $(this).find('.cart_item_del').click(function(){
                let cartid = $(this).closest('tr').attr('data-id');
                
                if(confirm('정말 삭제하시겠습니까?')){

                let data = {
                    cartid: cartid
                }
                $.ajax({
                    async: false,
                    type: 'POST',
                    url: 'cart_delete.php',
                    data: data,
                    dataType: 'json',
                    error: function(error){
                        console.log(error);
                    },
                    success: function(data){
                        if(data.result == 'ok'){
                            alert('장바구니에 삭제되었습니다.');
                            location.reload();
                        }else{
                            alert('삭제 실패');
                        }
                    }
                });
            }else{
                alert('삭제를 취소했습니다');
            }
            })
        })
        $('.subtotal').text(subtotal);
    }
    cartCalc();


    // 쿠폰 적용하기
    let ucid;
    $('#coupon').change(function(){
        let coupon_price =  $('#coupon option:selected').attr('data-price');
        
        ucid = $('#coupon option:selected').val();

        $('.discount').text('-'+coupon_price);
        $('.grandtotal').text($('.subtotal').text() - coupon_price);
    })

    $('.checkout-btn').click(function(e){
        e.preventDefault();
        if(confirm('결제 하시겠습니까?')){
            let userid = '<?= $_SESSION['UID']; ?>'
            
            let data = {
                ucid: ucid,
                userid: userid
            }
            $.ajax({
                    async: false,
                    type: 'POST',
                    url: 'payment.php',
                    data: data,
                    dataType: 'json',
                    error: function(error){
                        console.log(error);
                    },
                    success: function(data){
                        if(data.result == 'ok'){
                            alert('결제 완료');
                            location.href = "/abcmall/index.php"
                        }else{
                            alert('결제 실패');
                            location.reload();
                        }
                    }
                });
        }else{
            alert('취소되었습니다.')
        }
    })
  </script>



<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/attention_renewal/user/inc/footer.php';
?>