<?
    // 메일링 함수
    /**
     * $title       : 제목
     * $content     : 내용
     * $toEmail     : 받는 이메일
     * $toName      : 받는 사람
     * $fromEmail   : 보내는 이메일
     * $fromName    : 보내는 사람
     * */
    require_once( dirname(__FILE__) . "/PHPMailer/PHPMailerAutoload.php" );
    function sendMailSimple($title, $content, $toEmail, $toName="", $fromEmail="noReply@dutyfreeone.co.kr", $fromName="부산항 면세점(DutyFreeOne)") {
        $mail = new PHPMailer;
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.mailgun.org';                     // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'postmaster@mail.dutyfreeone.co.kr';      // SMTP username
        $mail->Password = 'ddf7b93d46609840cf38ec757a43e3fe';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable encryption, only 'tls' is accepted

        $mail->From = $fromEmail;
        $mail->FromName = $fromName;
        //$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
        $mail->addAddress($toEmail, $toName);                 // Add a recipient
        $mail->Subject = $title;
        $mail->Body    = $content;

        $sendMailResult = "N";
        if(!$mail->send()) {
            // 메일링 실패
            /*
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            */
        } else {
            // 메일링 성공
            //echo 'Message has been sent';
            $sendMailResult = "Y";
        }
        return $sendMailResult;
    }
?>