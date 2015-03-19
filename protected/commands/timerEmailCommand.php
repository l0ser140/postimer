<?php
    class timerEmailCommand extends CConsoleCommand
    {
        
        public function actionSendMail(){

             date_default_timezone_set('UTC');
             
             $startdate=date('Y-m-d H:i:s',strtotime('+1 hours'));
             $enddate=date('Y-m-d H:i:s',strtotime('+2 hours 1 minute'));
             
             $Poses=Pos::model()->findAll(array(
                                      'select'=>'*',
                                      'condition'=>'date > "'.$startdate.'" and date < "'.$enddate.'"',
                                      ));

             $users=User::Model()->findAll(array(
                                        'select'=>'*',
                                        ));
                                                 
             $subject='POS Timer Alert';
                                      
             foreach ($Poses as $pos){
                
                $message='The '.$pos->type.' in '.$pos->location.' is due out of reinforced at '.$pos->date.PHP_EOL;
                 
                foreach ($users as $user){
                    $profiles=Profile::model()->findByPk($user->id);
                    if ($profiles->subscribe):
                        $email=$user->email;
                        echo $email.'  '.$subject.'  '.$message;
                        UserModule::sendMail($email,$subject,$message);
                    endif;
                }
             }
        }
    }
?>
