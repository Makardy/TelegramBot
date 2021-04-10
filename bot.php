я<?php
//конфиги которые не нужно трогать
include_once ('system.php'); //подключаем system.php
$body = file_get_contents('php://input'); //Получаем в $body json строку
$json = json_decode($body, true); //Разбираем json запрос
  
//Получаем текст сообщения, которое нам пришло.
$sms = $json['message']['text'];

//Айди кому отправляем сообщение
$tg_id = $json['message']['chat']['id'];

//Имя кому отправляем сообщение
$tg_username = $json['message']['chat']['username'];





        $buttons = json_encode([
            "keyboard" => [

                [
                    ["text" => "😎 Правила",],
                    ["text" => "🎟 Моя подписка",],
                    ["text" => "💸 Продлить подписку",],
                ],
               // второй ряд 
               [
                    ["text" => "💝 Фото",],
                    ["text" => "💖 Видео",],
                ],

               // третий ряд
               [
                  ["text" => "🖤 Даркнет",],
                  ["text" => "❤️ Приват",],
                ],

           ],
           'one_time_keyboard' => false,
            'resize_keyboard' => true,
            'selective' => true,
       ], true);

//Загрузка команды заданной клавиатуре
$postfields = array('chat_id' => "$tg_id",'parse_mode' => "markdown",'text' => "🕔 Команда загружена успешно",'reply_markup' => $buttons);

//обработка
print_r($postfields);
if (!$curld = curl_init()) { 
exit;
}
curl_setopt($curld, CURLOPT_POST, true);
curl_setopt($curld, CURLOPT_POSTFIELDS, $postfields);
curl_setopt($curld, CURLOPT_URL,$ApiUrl.$token.'/sendMessage');
curl_setopt($curld, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec($curld);
curl_close ($curld);

//Приветственное сообщение при запуске бота
if ($sms == '/start') {
    
$message = '💋 *Приветик, шалун*

😈 Тут ты можешь взять то, зачем сюда пришел - а именно приватные фото/видео несовершеннолетних

❤️ Для большего понимания что тут находится, ознакомься с кнопками в боте ❤️ 

❕ С уважением Администрация бота
😜 Приятных покупок
';
$go -> send($tg_id, $message);
} 


// Тарифы
if ($sms == '😎 Правила') {
$message = '1. Не сливать в другие источники фотографии полученные в данном боте
2. Не перепродавать свою подписку
3. Не зарабатывать на фотографиях полученных в боте
4. 1 аккаунт - 1 подписка, никаких совместных пользований мы не одобряем
5. Если Вы случайно узнали в человеке на фотографиях или видео знакомое лицо не стоит выносить это за рамки дальше этого бота - оставьте все в тайне

В случаях нарушения хотя бы одного из правил Вы будете заблокированы, а подписка обнулится.
';
$go -> send($tg_id, $message);
}

// Тарифы
if ($sms == '🎟 Моя подписка') {
$message = '🎟 У Вас нет действующей подписки.

💵 Стоимость за месяц подписки: '.$price.' руб.

Купить подписку можно командой /buy или кнопкой в меню "💸 Продлить подписку"
';
$go -> send($tg_id, $message);
}

// Покупка
if ($sms == '/buy') {
$message = '🤑 Покупка подписки

💵 Стоимость за месяц подписки: '.$price.' руб.

_Для покупки месячного доступа к функциям бота необходимо пройти по данной ссылке:_
https://qiwi.com/transfer/form.action?currency=RUB&amountFraction=0&extra%5B%27account%27%5D='.$qiwi.'&extra%5B%27comment%27%5D=Подписка@'.$tg_username.'&amountInteger='.$price.'&blocked%5B0%5D=sum&blocked%5B1%5D=comment&blocked%5B2%5D=account
';
$go -> send($tg_id, $message);
}

// Покупка
if ($sms == '❤️ Приват') {
$message = '🤑 Покупка подписки

💵 Стоимость за месяц подписки: '.$price.' руб.

_Для покупки месячного доступа к функциям бота необходимо пройти по данной ссылке:_
https://qiwi.com/transfer/form.action?currency=RUB&amountFraction=0&extra%5B%27account%27%5D='.$qiwi.'&extra%5B%27comment%27%5D=Подписка@'.$tg_username.'&amountInteger='.$price.'&blocked%5B0%5D=sum&blocked%5B1%5D=comment&blocked%5B2%5D=account
';
$go -> send($tg_id, $message);
}

// Покупка
if ($sms == '🖤 Даркнет') {
$message = '🤑 Покупка подписки

💵 Стоимость за месяц подписки: '.$price.' руб.

_Для покупки месячного доступа к функциям бота необходимо пройти по данной ссылке:_
https://qiwi.com/transfer/form.action?currency=RUB&amountFraction=0&extra%5B%27account%27%5D='.$qiwi.'&extra%5B%27comment%27%5D=Подписка@'.$tg_username.'&amountInteger='.$price.'&blocked%5B0%5D=sum&blocked%5B1%5D=comment&blocked%5B2%5D=account
';
$go -> send($tg_id, $message);
}

// Покупка
if ($sms == '💖 Видео') {
$message = '🤑 Покупка подписки

💵 Стоимость за месяц подписки: '.$price.' руб.

_Для покупки месячного доступа к функциям бота необходимо пройти по данной ссылке:_
https://qiwi.com/transfer/form.action?currency=RUB&amountFraction=0&extra%5B%27account%27%5D='.$qiwi.'&extra%5B%27comment%27%5D=Подписка@'.$tg_username.'&amountInteger='.$price.'&blocked%5B0%5D=sum&blocked%5B1%5D=comment&blocked%5B2%5D=account
';
$go -> send($tg_id, $message);
}

// Покупка
if ($sms == '💝 Фото') {
$message = '🤑 Покупка подписки

💵 Стоимость за месяц подписки: '.$price.' руб.

_Для покупки месячного доступа к функциям бота необходимо пройти по данной ссылке:_
https://qiwi.com/transfer/form.action?currency=RUB&amountFraction=0&extra%5B%27account%27%5D='.$qiwi.'&extra%5B%27comment%27%5D=Подписка@'.$tg_username.'&amountInteger='.$price.'&blocked%5B0%5D=sum&blocked%5B1%5D=comment&blocked%5B2%5D=account
';
$go -> send($tg_id, $message);
}

// Покупка
if ($sms == '💸 Продлить подписку') {
$message = '😇 Доступно: 0 дней.

💵 Стоимость за месяц подписки: '.$price.' руб.

_Для покупки месячного доступа к функциям бота необходимо пройти по данной ссылке:_
https://qiwi.com/transfer/form.action?currency=RUB&amountFraction=0&extra%5B%27account%27%5D='.$qiwi.'&extra%5B%27comment%27%5D=Подписка@'.$tg_username.'&amountInteger='.$price.'&blocked%5B0%5D=sum&blocked%5B1%5D=comment&blocked%5B2%5D=account
';
$go -> send($tg_id, $message);
}



// Автор - @crydollar 
exit('crydollar'); 
?>