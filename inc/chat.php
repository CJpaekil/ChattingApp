<?php 
		$touser = p_s($_GET['id']);
		$fromuser = $_SESSION['id'];
	if (isset($_POST['sendmsg'])) {
		$msg= p_s($_POST['msg']);

		if ($conv_id = start_conv($fromuser, $touser)) {
			$sql = "INSERT INTO conv_reply (conv_id,user_id,content) VALUES('$conv_id','$fromuser','$msg')";
			if (mysqli_query($conn,$sql)) {
				header('Location: chat.php?id='.$touser);
			}
		}
	}

 ?>
<div class="container">
	<div class="msgs" style="height: 60vh; overflow-y: auto">
		<?php 
		if (!empty(getMsgs($fromuser,$touser))) {
			foreach (getMsgs($fromuser,$touser) as $msg) {
				if ($msg['user_id'] == $_SESSION['id']) {
					echo '<div>
						<div  class="alert alert-info" style="border-radius: 10px !important;background-color:#F1F1F4;color:black;font-size:13px;width:60%;float:right">'.$msg['content'].'</div>
					</div>';
				}else{
					if (msgSeen($msg['id'])) {
						
					}
					echo '<div><div class="alert alert-success" style="border-radius: 10px !important;background-color:#C165C5;font-size:13px;color:white;width:60%;float:left">'.$msg['content'].'</div></div>';
				}
			}
		}

		 ?>
	</div>
	<div class="sendmsg">
		<form class="action="" method="POST">
			<div style="display: flex;height:40px">
				<textarea style="border-radius: 25px !important;width:88%" class="form-control" rows="3" name="msg"></textarea>
				<button style="border-radius: 25px !important;margin-left:1%; width:12%" class="btn  btn-success" name="sendmsg">Send</button>		
			</div>	
		</form>

	</div>
</div>