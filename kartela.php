<?php 
    include("header.php");
    include("top_menu.php");
    include("menu.php");

    function gjenero_receta_temeparshme() {
     	require("admin_db/lidhje_db.php");

	     $query = " SELECT * FROM diagnoza where emri_pacientit = '".$_SESSION["emri"]."' and mbiemri_pacientit = '".$_SESSION["mbiemri"]."' ";

	     $tedhena = mysqli_query($db_connect, $query);

	     if ($tedhena) {
	     	while ($row = mysqli_fetch_array($tedhena)) { 
	 	    	echo '
	 	    		
	 		            <tr>
	 		                <td>' .$row['diagnozeID']. '</td>
	 			            <td>' .$row['emertimi']. '</td>
	 			            <td>' .$row['pershkrim_diagnoze']. '</td> 
	 			            <td>' .$row['simptomat']. '</td>
	 			            <td>
							<button type="button" id="'.$row['diagnozeID'].'" title="Download" class="btn btn-danger btn-xs btn_download_recete" data-toggle="modal" data-target="#modal_downloadrecete">
								<i class="fa fa-ban" aria-hidden="true"> </i> 
							</button>
			            </td>
	 		        	</tr>
	 		        
	 	    	';
 	    }
 	     echo '</table>';
	     } else {
	     	echo '
	     		<div class="alert alert-danger">
	 				<center><strong>Nuk u gjet asnje informacion!!</strong></center>
	 			</div>
	 			</table>
	     	';	    
     	}
	 }

?>


	 <div id="page-wrapper" >
	<div class="header"> 
		<h3 class="page-header">
			Kartela
			
		</h3>
	</div>
	<hr style="height: 1px; background-color: #ccc; border: none;" >
	
	<!--/. main content per cdo faqe fillon ketu  -->
	<div id="page-inner">
		<div class="row">
			<div class="col-md-12">
				<!--/. header i tabeles per listen e rezervimeve -->
				<div class="panel-heading">
                    Recetat e dhena
                </div>
                <!--/. header i tabeles per listen e rezervimeve -->

                <!--/. tabela me listen e rezervimeve -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
				            <thead class="thead-dark">
				                <tr>
				                    <th> Nr. </th>
				                    <th>Diagnoza</th>
				                    <th>Pershkrimi</th>
				                    <th>Simptomat</th>
				                    <th style="width:10%;">Veprime</th>
				                </tr>
				            </thead> 
				            <?php 
				            gjenero_receta_temeparshme(); 
				            ?>
				        
                    </div>
                </div>
                <!--/. tabela me listen e rezervimeve -->
			</div>
    	</div>