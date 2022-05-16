<?php
    $msg_box = ""; // в этой переменной будем хранить сообщения формы
    $errors = array(); // контейнер для ошибок
    // проверяем корректность полей
    $msg_box = "<span style='color: #0082C3; font-size: 1.4em;'>Thank you, your message was sent.</br> The consultant will contact you soon.</span>";

    if($_POST['lang'] == "ru") {
        if($_POST['form_email'] == "")   $errors[] = "Поле <span style='color: #666;'>Ваш e-mail</span> не заполнено";
        if($_POST['form_name'] == "")    $errors[] = "Поле <span style='color: #666;'>Ваше имя</span> не заполнено";
	    if($_POST['form_tel'] == "")   $errors[] = "Поле <span style='color: #666;'>Ваш телефон</span> не заполнено";
        if($_POST['form_company'] == "")    $errors[] = "Поле <span style='color: #666;'>Название компании</span> не заполнено";
        if($_POST['form_message'] == "") $errors[] = "Поле <span style='color: #666;'>Текст сообщения</span> не заполнено";
        $msg_box = "<span style='color: #0082C3; font-size: 1.4em;'>Спасибо за обращение, сообщение успешно отправлено! <br/> Специалисты свяжутся с Вами в течение рабочего времени.<br/></span><br/>";

    } else {
        if($_POST['form_email'] == "")   $errors[] = "Field <span style='color: #666;'>Your e-mail</span> is empty";
        if($_POST['form_name'] == "")    $errors[] = "Field <span style='color: #666;'>Your name</span> is empty";
	    if($_POST['form_tel'] == "")   $errors[] = "Field <span style='color: #666;'>Your phone number</span> is empty";
        if($_POST['form_company'] == "")    $errors[] = "Field <span style='color: #666;'>Your company</span> is empty";
        if($_POST['form_message'] == "") $errors[] = "Field <span style='color: #666;'>Message</span> is empty";
        $msg_box = "<span style='color: #0082C3; font-size: 1.4em;'>Thank you, your message was sent.</br> The consultant will contact you soon.<br/></span><br/>";

        //if($_POST['form_message'] == "") $errors[] = "Field <span style='color: #666;'>Текст сообщения</span> Thank you, your message was sent.</br> The consultant will contact you soon.";
    }
	
 
    // если форма без ошибок
    if(empty($errors)){     
        // собираем данные из формы
        $message  = "Имя пользователя: " . $_POST['form_name'] . "<br/>";
        $message .= "E-mail пользователя: " . $_POST['form_email'] . "<br/><br/>";
	    $message .= "Телефон пользователя: " . $_POST['form_tel'] . "<br/><br/>";
		$message .= "Название компании: " . $_POST['form_company'] . "<br/><br/>";
        $message .= "Текст письма: " . $_POST['form_message'];      
        send_mail($message); // отправим письмо
        // выведем сообщение об успехе

    }else{
        // если были ошибки, то выводим их
        $msg_box = "";
        foreach($errors as $one_error){
            $msg_box .= "<style>.messages{margin-bottom: 20px;}</style><span style='color: red;font-size: 1.2em;'>$one_error</span><br/>";
        }
    }
 
    // делаем ответ на клиентскую часть в формате JSON
    echo json_encode(array(
        'result' => $msg_box
    ));
     
     
    // функция отправки письма
    function send_mail($message){
        // почта, на которую придет письмо
        $mail_to = "kate_nv@bk.ru"; 
        
        // тема письма
        $subject = "Письмо с обратной связи";
         
        // заголовок письма
        $headers= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n"; // кодировка письма
        $headers .= "From: Енисей <no-reply@test.com>\r\n"; // от кого письмо
         
        // отправляем письмо 
        mail($mail_to, $subject, $message, $headers);
    }
     
?>