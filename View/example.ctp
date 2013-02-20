<h2>SisowIdeal test:</h2>

<?php echo $this->Form->create('Payment',array('url'=>array('plugin'=>'sisow_ideal','controller'=>'dummies','action'=>'payment'))); ?>
<div class="select">
	<label></label> 
	<select id="PaymentBank" name="data[Payment][bank]">
		<script src="https://www.sisow.nl/Sisow/iDeal/issuers.js"></script>
	</select>
</div>

<?php
echo $this->Form->end('Pay');
?>