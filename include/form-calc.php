<script>
$(function(){
    $('input.phone,input[name="phone"]').mask('+7(999)999-99-99', {placeholder: '+7(___)___-__-__'});
    
    // отправка формы
    $('body').on('click', '.submit-button', function (e) {
    e.preventDefault();
    console.log($('#re_input_phone')[0].value);
    if($('#re_input_name')[0].value != "" && $('#re_input_phone')[0].value != "" && $('#re_input_phone')[0].value != "+7(___)___-__-__"){
        var self = this,
            $form = $(this).parents('form');
        var fd = new FormData($form[0]); 
            $.ajax({
                url: '/local/ajax/form_action.php',
                dataType : 'json',
                data: fd,//$form.serialize(),//
                type: 'POST',
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.error) {
                        var $slidebox = $('.formerr').html(data.messages).removeClass('hidden');
                        $.fancybox.open([$slidebox]);
                        //$('.fancybox-close').hide();
                    }
                    if (data.success) {
                        <?date_default_timezone_set("Asia/Novosibirsk");
						List($hour, $day) = split(":",date("G:w"));
						if($day > 0 && $day<6 && $hour>=9 && $hour<18){?>
                        var $slidebox = $('.formsuccess2').html(data.messages).removeClass('hidden');
						<?}else{?>
						var $slidebox = $('.formsuccess1').html(data.messages).removeClass('hidden');
						<?}?>
                        $.fancybox.open([$slidebox]);
                        $form.find('input[type="text"]').val('');
                        $(this).prop('disabled',true);
                        
                    }
                },
                error: function(xhr, str){
                    console.log('Возникла ошибка: ' + xhr.responseCode);
                }
            });
                }
    else{
        var $slidebox = $('.formerr').removeClass('hidden');
        $.fancybox.open([$slidebox]);
    }
    });
});
</script>
<form id="order_calс_form" class="form-calc form-inline clearfix" name="order_calс_form" action="" method="post" role="form">
    <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <input id="re_input_name" name="form_text_76" value="" class="form-control" type="text" placeholder="Имя" required>
        </div>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <input id="re_input_phone" name="form_text_77" value="" class="form-control phone" type="text" placeholder="+7 (_ _ _)_ _ _-_ _-_ _" required>
        </div>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-12">
        <input value="Посчитайте мне" id="order_calc_form_button" class="submit-button btn btn-default" type="submit">
    </div>
    <input type="hidden" name="WEB_FORM_ID" value="13" />
    <input type="hidden" name="sessid" value="<?php echo bitrix_sessid() ?>" />
</form>
<div class="formerror hidden"></div>
<div class="formsuccess1 hidden"><span>Спасибо за приглашение! Мы ответим в ближайшее время!</span></div>
<div class="formsuccess2 hidden"><span>Спасибо за приглашение! Мы ответим в течение 15 минут!</span></div>
<div class="formerr hidden"><span>Заполните пожалуйста оба поля!</span></div>
