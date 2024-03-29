<?php 
	if(isset($result_transaction)){ ?>
<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">transaction</h5>
	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">ID</th>
			<th scope="col">CLIENT ID</th>
			<th scope="col">TRANSACTION ID</th>
			<th scope="col">MAKER</th>
			<th scope="col">CHECKER</th>
			<th scope="col">APPROVER</th>
			<th scope="col">CHECKWORK</th>
			<th scope="col">CHECKTOTAL</th>
			<th scope="col">APPROVEWORK</th>
			<th scope="col">APPROVETOTAL</th>
			<th scope="col">STATUS</th>
			<th scope="col">NEXTPROCESSOR</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				
			foreach($result_transaction as $key => $d){
				?>
				<tr>
					<th scope="row"><small><?php echo ($key+1);?></small></th>
					<td><small><?php echo $d->ID;?></small></td>
					<td><small><?php echo $d->CLIENTID;?></small></td>
					<td><small><?php echo $d->TRANSACTIONID;?></small></td>
					<td><small><?php echo $d->MAKER;?></small></td>
					<td><small><?php echo $d->CHECKER;?></small></td>
					<td><small><?php echo $d->APPROVER;?></small></td>
					<td><small><?php echo $d->CHECKWORK;?></small></td>
					<td><small><?php echo $d->CHECKTOTAL;?></small></td>
					<td><small><?php echo $d->APPROVEWORK;?></small></td>
					<td><small><?php echo $d->APPROVETOTAL;?></small></td>
					<td><small><?php echo $d->STATUS;?></small></td>
					<td><small><?php echo $d->NEXTPROCESSOR;?></small></td>
				</tr>
				<?php
			}
			
			?>
		</tbody>
	  </table>
	  </div>
	  <!-- End Table with stripped rows -->
	</div>
</div>
<?php } ?>

<?php 
	if(isset($result_trxtransferbri)){ ?>
<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">trxtransferbri</h5>
	  	<!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">ID</th>
			<th scope="col">TRXID</th>
			<th scope="col">STATUS</th>
			<th scope="col">CLIENT ID</th>
			<th scope="col">VAORIGACC</th>
			<th scope="col">JURNALSEQ1</th>
			<th scope="col">JURNALSEQ2</th>
			<th scope="col">TRXDATE</th>
			<th scope="col">LASTUPDATE</th>
			<th scope="col">DEBITACCOUNT</th>
			<th scope="col">CREDITACCOUNT</th>
			<th scope="col">INSTAMT</th>
			<th scope="col">INSTCUR</th>
			<th scope="col">TRXREMARK</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				
			foreach($result_trxtransferbri as $key => $d){
				?>
				<tr>
					<th scope="row"><small><?php echo ($key+1);?></small></th>
					<td><small><?php echo $d->ID;?></small></td>
					<td><small><?php echo $d->TRXID;?></small></td>
					<td><small><?php echo $d->STATUS;?></small></td>
					<td><small><?php echo $d->CLIENTID;?></small></td>
					<td><small><?php echo $d->VAORIGACC;?></small></td>
					<td><small><?php echo $d->JURNALSEQ1;?></small></td>
					<td><small><?php echo $d->JURNALSEQ2;?></small></td>
					<td><small><?php echo $d->TRXDATE;?></small></td>
					<td><small><?php echo $d->LASTUPDATE;?></small></td>
					<td><small><?php echo $d->DEBITACCOUNT;?></small></td>
					<td><small><?php echo $d->CREDITACCOUNT;?></small></td>
					<td><small><?php echo $d->INSTAMT;?></small></td>
					<td><small><?php echo $d->INSTCUR;?></small></td>
					<td><small><?php echo $d->TRXREMARK;?></small></td>
				</tr>
				<?php
			}
			
			?>
		</tbody>
	  </table>
	  </div>

	  <!-- End Table with stripped rows -->
	</div>
</div>
<?php } ?>

<?php 
	if(isset($result_booking)){ ?>
<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">trxtransferbri</h5>
	  	<!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">ID</th>
			<th scope="col">TRXID</th>
			<th scope="col">STATUS</th>
			<th scope="col">DESCRIPTION</th>
			<th scope="col">STATUS EC</th>
			<th scope="col">BOOKTYPE</th>
			<th scope="col">DEBITACCOUNT</th>
			<th scope="col">CREDITACCOUNT</th>
			<th scope="col">JURNALSEQ</th>
			<th scope="col">LASTUPDATE</th>
			<th scope="col">INSTAMOUNT</th>
			<th scope="col">INSTCURRENCY</th>
			<th scope="col">TELLERID</th>
			<th scope="col">TRANCODE</th>
			<th scope="col">TRXREMARK</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				
			foreach($result_booking as $key => $d){
				?>
				<tr>
					<th scope="row"><small><?php echo ($key+1);?></small></th>
					<td><small><?php echo $d->ID;?></small></td>
					<td><small><?php echo $d->TRXID;?></small></td>
					<td><small><?php echo $d->STATUS;?></small></td>
					<td><small><?php echo $d->DESCRIPTION;?></small></td>
					<td><small><?php echo $d->STATUSEC;?></small></td>
					<td><small><?php echo $d->BOOKTYPE;?></small></td>
					<td><small><?php echo $d->DEBITACCOUNT;?></small></td>
					<td><small><?php echo $d->CREDITACCOUNT;?></small></td>
					<td><small><?php echo $d->JURNALSEQ;?></small></td>
					<td><small><?php echo $d->LASTUPDATE;?></small></td>
					<td><small><?php echo $d->INSTAMOUNT;?></small></td>
					<td><small><?php echo $d->INSTCURRENCY;?></small></td>
					<td><small><?php echo $d->TELLERID;?></small></td>
					<td><small><?php echo $d->TRANCODE;?></small></td>
					<td><small><?php echo $d->TRXREMARK;?></small></td>
				</tr>
				<?php
			}
			
			?>
		</tbody>
	  </table>
	  </div>

	  <!-- End Table with stripped rows -->
	</div>
</div>
<?php } ?>


<script type="text/javascript">
$(document).ready(function(){
	
	
});
</script>
