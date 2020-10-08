<?php

    /**
     * Example: Get and parse all emails without saving their attachments.
     *
     * @author Sebastian Krätzig <info@ts3-tools.info>
     */
declare(strict_types=1);
namespace PhpImap;

include('config.php');
include('connection.php');
include('PhpImap/Mailbox.php');
include('PhpImap/Imap.php');
include('PhpImap/IncomingMailHeader.php');
include('PhpImap/IncomingMailAttachment.php');
include('PhpImap/IncomingMail.php');
include('PhpImap/DataPartInfo.php');
include('PhpImap/Exceptions/ConnectionException.php');
include('PhpImap/Exceptions/InvalidParameterException.php');

    //require_once __DIR__.'/../vendor/autoload.php';
	//require './../vendor/autoload.php';
   // use PhpImap\Exceptions\ConnectionException;
   // use PhpImap\Mailbox;

// include all the files 
set_time_limit(12000);

//echo $downloadMailCount;
		
$totalInserted = 0;
	//Get email id 
		$mailboxArr = []; 
		$sql = "SELECT * FROM em_emailconfig where isactive='Y'";
	
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
		  // output data of each row
		  while($row = mysqli_fetch_assoc($result)) {
			//echo "<br>Account: " . $row["AccountName"]. " - Password: " . $row["Password"]. " - Delete: " . $row["DeleteafterDownload"]. //"<br>";
	echo "<br>Account: " . $row["AccountName"]. " - Password: ****** - Delete: " . $row["DeleteafterDownload"]." <br>";	
			
			$mailbox = new Mailbox(      
			'{imap.gmail.com:993/imap/ssl}INBOX', // IMAP server and mailbox folder
			$row["AccountName"], // Username for the before configured mailbox
			$row["Password"], // Password for the before configured username "'" .$row["Password"]. "'"
			'D:\Log',  // Directory, where attachments will be saved (optional)
			'US-ASCII' // Server encoding (optional)
			); 
			
			
			/* $mailbox = new Mailbox(      
			'{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX', // IMAP server and mailbox folder
			'careers@eliteinfosoft.com', // Username for the before configured mailbox
			'pass123', // Password for the before configured username
			'D:\Log',  // Directory, where attachments will be saved (optional)
			'US-ASCII' // Server encoding (optional)
			); */
			
			array_push($mailboxArr, $mailbox);
			
			$mailbox->setServerEncoding('US-ASCII');

			try {
				//$mail_ids = $mailbox->searchMailbox('SEEN');
				
				//$mail_ids = $mailbox->searchMailbox('UNSEEN');
				
				$mail_ids = $mailbox->searchMailbox('ALL');
				
				
			} catch (ConnectionException $ex) {
				die('IMAP connection failed: '.$ex->getMessage());
			} catch (Exception $ex) {
				die('An error occured: '.$ex->getMessage());
			}
			
			if(!$mail_ids) {
				die('Mailbox is empty');
			}
			
			echo "<br>Account: " . $row["AccountName"]. " - No of Emails Got : ".count($mail_ids)."<br>";
			
			$event = 'Connect To Mail Box';
			pass_Data_eventLog($event_conn, $row["AccountName"], $event);
			
			passDataToDB($row, $mailbox, $mail_ids, $conn, $totalInserted, $event_conn, $downloadMailCount);
			
		  }
		} else {
		  echo "0 results";
		}
		
		//mysqli_close($conn);
		
function pass_Data_eventLog ($event_conn, $a_Name, $event){

	$current_date = date("Y-m-d H:i:s"); 

	$sql = "INSERT INTO `sa_eventlog` (`EventName`,`EventDesc`,`EventDateTime`,`EventSessionID`,`EventLogBy`,`MasterName`,`ApplicationName`,`Custom1`,`Custom2`,`Custom3`)
	VALUES ('".$event."','".$a_Name."','".$current_date."','','','','','','','')";	
							
	echo $sql;		
							
	if (mysqli_query($event_conn, $sql)) {
		echo "<br>New Event Log created successfully<br>";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($event_conn);
	}
	

}//Event log end 
		
		$mailbox->disconnect();
			
	//Get email id end 	

      /*$mailbox = new Mailbox(      
        '{imap.gmail.com:993/imap/ssl}INBOX', // IMAP server and mailbox folder
        'Purchase.cphr@gmail.com', // Username for the before configured mailbox
        'bhxxxxxx', // Password for the before configured username
        'D:\Log', // Directory, where attachments will be saved (optional)
        'US-ASCII' // Server encoding (optional)
		);

		// If you haven't defined the server encoding (charset) in 'new Mailbox()', you can change it any time
		/*$mailbox->setServerEncoding('US-ASCII');
		//$mailbox->setServerEncoding('UTF-8');

		try {
			//$mail_ids = $mailbox->searchMailbox('SEEN');
			
			//$mail_ids = $mailbox->searchMailbox('UNSEEN');
			
			$mail_ids = $mailbox->searchMailbox('ALL');
			
			
		} catch (ConnectionException $ex) {
			die('IMAP connection failed: '.$ex->getMessage());
		} catch (Exception $ex) {
			die('An error occured: '.$ex->getMessage());
		}
		
		if(!$mail_ids) {
			die('Mailbox is empty');
		}
		echo "No of Emails Got : ".count($mail_ids)."<br>";
		*/
	
	$test = 10;
	
	$_SESSION['filename'] = "new value";
	
function passDataToDB ($row, $mailbox, $mail_ids, $conn, $totalInserted, $event_conn, $downloadMailCount){

	$lengthofMail = $downloadMailCount;
	
	for($i=0; $i<$lengthofMail; $i++)
	{	
		$email = $mailbox->getMail($mail_ids[$i]);
		
		$ISreplace = ["'", "`", "’"];
		$replceWith = ["", "", ""];
	
		echo "\n Debug show All Mail content<br>";
		//echo "<pre>";
		//print_r($email);
		//echo "</pre>";
		if($email->hasAttachments()){
			echo "Yes<br>";
			 if (!empty($email->getAttachments())) {
				$totalAttchments = count($email->getAttachments());
			}

			// get attachments one by one
			if (!$mailbox->getAttachmentsIgnore()) {
				
				$attachments = $email->getAttachments();
				
				$attachements_names = "";
				
				foreach ($attachments as $attachment) {
					
					$attachements_names = $attachment->name .','.$attachements_names;
					
				}//For loop end
				
				$attachements_names = rtrim($attachements_names, ',');
				
				$attachements_names = str_replace($ISreplace, $replceWith, $attachements_names);
			}
			
		} else {
			$attachements_names = "";
			$totalAttchments = 0;
		}
		
		//Mail Body
		if ($email->textHtml) {
			$emailBody = $email->textHtml;
			$emailBody = str_replace($ISreplace, $replceWith, $emailBody);
        } else {
			$emailBody = $email->textPlain;
			$emailBody = str_replace($ISreplace, $replceWith, $emailBody);
        }
		
		$current_date = date("Y-m-d H:i:s"); 
		
		$ReceivedDate=date_create($email->date);
		
		$ReceivedDate = date_format($ReceivedDate, "Y-m-d H:i:s");
		
		//Check  duplicate
		$checkMsgID = "SELECT count(*) as Count FROM em_mails where EmailID ='".$row["AccountName"]."' And messageId='". (string) $email->messageId."'";
		
		echo "<br>Check msg id = ".	$checkMsgID ."<br>";
		
			$result = mysqli_query($conn, $checkMsgID);
			if (mysqli_num_rows($result) > 0) {
			  // output data of each row
			  while($Erow = mysqli_fetch_assoc($result)) {
				echo "<br>Count: " . $Erow["Count"]. "<br>";
				
				if($Erow["Count"] == 0){
					echo "<br> single</br>";
					//Insert start
						$sql = "INSERT INTO `em_mails` (`EmailID`,`UID`,`MessageId`,`MessageNumber`,`FromName`,`FromEmailID`,`Subject`,`Body`,`Attachments`,`DateRecieved`,`DateModified`,`Custom1`,`Custom2`,`Custom3`,`Custom4`,`Custom5`)
							VALUES ('".$row["AccountName"]."','UID','". (string) $email->messageId."',1,'". (string) $email->fromName."','". (string) $email->fromAddress."','". (string) $email->subject."','". (string) $emailBody."',". $totalAttchments.",'". (string) $ReceivedDate."','".$current_date."','". (string) $attachements_names."','','','','')";	
							
					//echo $sql;		
							
					if (mysqli_query($conn, $sql)) {
						
						$lastInsertID = mysqli_insert_id($conn);
						$totalInserted = $totalInserted + 1 ;
					  echo "<br>New record created successfully<br>". $lastInsertID;
					  
					  //Attachment 
							echo "\nMail has attachments? ";
							if($email->hasAttachments()){
								 if (!empty($email->getAttachments())) {
									echo \count($email->getAttachments())." attachements\n";
								}

								// Save attachments one by one
								if (!$mailbox->getAttachmentsIgnore()) {
									$attachments = $email->getAttachments();
									
									$attachements_names = "";
									
									foreach ($attachments as $attachment) {
										
										echo '--> Saving '.(string) $attachment->name.'...<br>';
										
										$attachements_names = $attachment->name .','.$attachements_names;
										
										// Set individually filePath for each single attachment
										// In this case, every file will get the current Unix timestamp
										
										//$newDir =  'Attachments_New/'.(string)$lastInsertID.'/';	
										$newDir =  'Attachments_elite/'.(string)$lastInsertID.'/';	
											if (!is_dir($newDir)) {
												mkdir($newDir);	
											}
										
										$attachment->setFilePath(__DIR__.'/'.(string) $newDir .(string) $attachment->name);

										if ($attachment->saveToDisk()) {
											echo "OK, saved!\n";
										} else {
											echo "ERROR, could not save!\n";
										}
									}//For loop end
									
									$attachements_names = rtrim($attachements_names, ',');
									echo '<br>Attachment list --> '.$attachements_names.'<br>';
									
								}
						
								} else {
									$attachements_names = "";
									$totalAttchments = 0;
									echo "No<br>";
								}
							  //End attachements
							  
							  //delete
							  if($row["DeleteafterDownload"] == 'Y'){
							  
								echo "Deleting email after download..".$mail_ids[$i];
						
								 $mailbox->deleteMail($mail_ids[$i]);
								 $mailbox->expungeDeletedMails();
								}
							  
							} else {
							  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
							}
					
					//Insert End 
				}else{
					echo "<br> Duplicate Entry </br></br>";
				}
				
				
			  } // while end 
			} else {
			  echo "0 results";
			}//else if end 
		//Check  duplicate end 
		
		
		
		echo "<hr>";
		
		
	} //End for loop
	
	$event = "Email Downloaded ";
	
	$event_Desc = "Total " .$totalInserted . " (" .$row["AccountName"]. ")";
	
	pass_Data_eventLog($event_conn, $event_Desc , $event);
		
	echo "<br> $totalInserted = ".$totalInserted ."<br>";
	echo "<hr>";
	
} //function passDataToDb End

mysqli_close($conn);

//$mailbox->disconnect();