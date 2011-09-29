<?php 
    // Русифицирует значение времени в годах. Например, '1 год', и '10 лет'.
    function getRuAge($value) {
        if (((int)$value >= 10) and ((int)$value <= 20)) {
            return 'лет';
        } else {
            if ((int)$value < 10) {
                $number = (int)$value;
            } else {
                $number = (int)$value % 10;
            }
            switch ($number) {
            case 1:
                return 'год';
            case 2:
            case 3:
            case 4:
                return 'года';
            case 5:
            case 6:
            case 7:
            case 8:
            case 9:
            case 0:
                return 'лет';
            }
        }
    }

  function getLogo($id) {
    if (file_exists('../htdocs/images/ins-logos/logo-company'.$id.'.gif')) {
      return '/images/ins-logos/logo-company'.$id.'.gif';
    } else {
      return '/images/ins-logos/logo-company.gif';
    }
  }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<!--[if lt IE 7]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class='no-js' lang='en'>
  <!--<![endif]-->
  <head>
    <meta charset='utf-8' />
    <meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible' />
    <title>Пример приземления</title>
    <meta content='Sample page for Yandex.Insurance integration for clients of Insurance Technologies.' name='description' />
    <meta content='Alexey Plutalov' name='author' />
    <meta content='width=device-width, initial-scale=1.0' name='viewport' />
    <link href='/css/style.css' media='all' rel='stylesheet' />
    <script src='/js/modernizr.min.js'></script>
    <script src='/js/respond.min.js'></script>
  </head>
  <body>
    <div id='page-doc-container'>
      <div class='container' id='page-doc'>
        <p>Это документация</p>
      </div>
      <div id='page-doc-tumbler'>
        <p>Полный архив с примером доступен тут: <a href=""></a>.</p>
      </div>
    </div>
    <div id='page-header-container'>
      <div class='container' id='page-header'>
        <div id='logo'>
          <img src='/images/landing/logo.png' />
        </div>
        <div id='contacts'>
          <p id='telephone'>+7 (495) 545-45-28</p>
          <p id='skype'>
            <span style='font-weight: bold;'>Skype:</span>
            <img height='14' src='/images/landing/skype_online.png' />
            store
          </p>
          <p id='time'>Будни: 11:00 - 20:00</p>
        </div>
        <div class='clear'></div>
      </div>
    </div>
    <div id='page-nav-container'>
      <div class='container' id='page-nav'>
        <p id='current-link'>
          <a href=''>Корзина</a>
        </p>
        <p id='bread-crumbs'>
          <a class='current' href=''>Оформление</a>
          &rarr;
          <a href=''>Подтверждение</a>
        </p>
      </div>
    </div>
    <div id='auto-info-container'>
      <div class='container' id='auto-info'>
        <div id='auto'>
          <div id='auto-name'>
            Страховка для <?php
                echo $calculation['car']['mark']['title'].' '.$calculation['car']['model']['title'];
                if ($calculation['car']['modification']) {
                    echo ' '.$calculation['car']['modification'];
                }
                if ($calculation['car']['year']) {
                    echo ', '.$calculation['car']['year'].' г.в.';
                }
            ?>
          </div>
          <table>
            <tr>
              <td id='insurance-company-logo' rowspan='2'>
                <img src='<?php echo getLogo($result['assurer']['id']); ?>' />
              </td>
              <th>
                Стоимость
              </th>
              <td>
                1 400 000 рублей
              </td>
            </tr>
            <?php 
                if ($calculation['drivers']['is_multidrive'] == '1') {
            ?>
            <tr>
                <th>
                    Мультидрайв
                </th>
                <td>
                    <p>Минимальный возраст: <?php echo $calculation['drivers']['min_age']; ?></p>
                    <p>Минимальный стаж: <?php echo $calculation['drivers']['min_experience']; ?></p>
                </td>
            </tr>    
            <?php 
                } else {
            ?>
            <tr>
                <th>
                    Водители
                </th>
                <td>
                    <?php
                        foreach ($calculation['drivers']['list'] as $driver) {
                            echo '<p>';
                            if ($driver['gender'] == 'M') {
                                echo 'мужчина, ';
                            } else {
                                echo 'женщина, ';
                            }        
                            echo $driver['age'].' '.getRuAge($driver['age']).', ';
                            echo $driver['experience'].' '.getRuAge($driver['experience']).' стажа';
                            echo '</p>';
                        }
                    ?>
                </td>                    
            </tr>    
            <?php 
                } 
            ?>
          </table>
        </div>
        <div id='price'>
          <p>
            <span id='price-value'><?php printf('%01.2f', $result[0]['bonus']); ?></span>
            <span id='price-currency'>руб.</span>
          </p>
          <img id='shopcart' src='/images/landing/shopcart.png' />
        </div>
        <div class='clear'></div>
      </div>
    </div>
    <div id='main-container'>
      <form action='' class='container' id='main' method='POST'>
        <input name="calculation_id" type="hidden" value="<?php echo $calculation_id; ?>"></input>
        <input name="assurer_id" type="hidden" value="<?php echo $assurer_id; ?>"></input>
        <input name="tarif" type="hidden" value="<?php echo $tarif; ?>"></input>
        <div id='left-part'>
          <p>
            <label>ИМЯ И ФАМИЛИЯ <span>*</span></label>
            <br />
            <input name='name' type='text' />
          </p>
          <p>
            <label>ГОРОД</label>
            <br />
            <select name='city'>
              <option value='Москва'>Москва</option>
              <option value='Санкт-Петербург'>Санкт-Петербург</option>
            </select>
          </p>
          <p>
            <label>СТАНЦИЯ МЕТРО <span>*</span></label>
            <br />
            <input name='metro' type='text' />
            <div class='tip'>Можно указать несколько, через запятую.</div>
          </p>
          <p>
            <label>АДРЕС ДОСТАВКИ <span>*</span></label>
            <br />
            <input name='address' type='text' />
            <div class='tip'>Улица, дом, квартира</div>
          </p>
          <p>
            <label>УДОБНОЕ ВРЕМЯ ИЛИ ДАТА ДОСТАВКИ</label>
            <br />
            <input name='datetime' type='text' />
            <div class='tip'>Укажите когда вам было бы удобно получить ваш заказ.</div>
          </p>
          <p>
            <label>ТЕЛЕФОН ДЛЯ СВЯЗИ <span>*</span></label>
            <br />
            <input name='phone' type='text' />
          </p>
          <p>
            <label>ЭЛЕКТРОННЫЙ АДРЕС ДЛЯ СВЯЗИ <span>*</span></label>
            <br />
            <input name='email' type='text' />
          </p>
          <p>
            <label>КОММЕНТАРИИ К ЗАКАЗУ</label>
            <br />
            <textarea name='comments' rows='7'></textarea>
            <div class='tip'>Напишите тут вещи, которые могут потребоваться курьеру, например код домофона иои удобное время доставки.</div>
          </p>
        </div>
        <div id='right-part'>
          <fieldset>
            <p>
              <input name='delivery' type='radio'>
                <label>САМОВЫВОЗ</label>
              </input>
              <div class='tip'>
                <p>Вы можете получить заказ прямо сегодня, позвонив по телефону</p>
                <p>+7 (495) 545-45-28 до 18.00. Стоимость услуги - 600 рублей.</p>
              </div>
            </p>
            <p>
              <input name='delivery' type='radio'>
                <label>КУРЬЕР</label>
              </input>
              <div class='tip'>Стоимость доставки в пределах КАД - 250.</div>
            </p>
          </fieldset>
          <p>
            <img src='/images/landing/map.png' />
          </p>
          <p>
            <label>СПОСОБ ОПЛАТЫ</label>
          </p>
          <fieldset>
            <p>
              <input name='payment-type' type='radio'>
                <label>Наличными</label>
              </input>
              <div class='tip'>Оплата наличными по факту доставки товара курьером (только по Москве). Курьер выдаст вам чек, который может вам понадобиться в случае обмена/возврата товара.</div>
            </p>
            <p>
              <input name='payment-type' type='radio'>
                <label>Банковской картой</label>
              </input>
              <div class='tip'>Моментальная оплата через безопасное соединение платежными картами Visa и MasterCard. Списание денежных средств с вашей карты происходит в момент передачи заказа в курьерскую службу. В случае отмены или возврата товара, потраченные средства будут возвращены на вашу карту.</div>
            </p>
          </fieldset>
        </div>
        <div class='clear'></div>
        <div id='finish'>
          <input type="submit" value="ПЕРЕЙТИ К ПОДТВЕРЖДЕНИЮ ЗАКАЗА &rarr;"></input>
        </div>
        <div class='clear'></div>
      </form>
    </div>
    <div id='page-footer-container'>
      <div class='container' id='page-footer'>
        <div class='footer-column'>
          <h3>Помощь</h3>
          <p>
            <a href=''>Заказ и оплата</a>
          </p>
          <p>
            <a href=''>Доставка</a>
          </p>
          <p>
            <a href=''>Возврат</a>
          </p>
          <p>
            <a href=''>Вопросы и ответы</a>
          </p>
        </div>
        <div class='footer-column'>
          <h3>Контакты</h3>
          <p>Телефон: ................ +7 (495) 545-45-28</p>
          <p>Будни: .................... 11:00 - 20:00</p>
        </div>
        <div class='footer-column'>
          <h3>Принимаем к оплате</h3>
          <img src='/images/landing/visa.png' />
          <img src='/images/landing/mastercard.png' />
          <img src='/images/landing/yandex.gif' />
          <img src='/images/landing/visa_electron.gif' />
          <img src='/images/landing/maestro.png' />
        </div>
        <div class='clear'></div>
      </div>
    </div>
    <script src='//ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.js'></script>
    <script type='text/javascript'>
      //<![CDATA[
        window.jQuery || document.write("<script src='js/jquery.min.js'>\x3C/script>")
      //]]>
    </script>
    <script src='js/script.js?v=1'></script>
  </body>
</html>
