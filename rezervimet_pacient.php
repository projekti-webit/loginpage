<?php 

	include("header.php");
    include("top_menu.php");
    include("menu.php");

    function doktoret () {
        require("admin_db/lidhje_db.php");
        $query = " select user_id, emri, mbiemri from perdoruesit where roli = 'staf' ";
        $rezultati = mysqli_query($db_connect, $query);
        //$row = mysqli_fetch_array($rezultati, MYSQLI_ASSOC);
        
        $option = "";
        
        while ($row = mysqli_fetch_assoc($rezultati)) {
            $option .= "
                <option value='{$row['user_id']}'> {$row['emri']} - {$row['mbiemri']}</option>
            ";
        }
        //$option .= "</option>";
        echo $option;
    }

     function gjenero_rezervime_temeparshme() {
     	require("admin_db/lidhje_db.php");

	     $query = " SELECT * FROM rezervim where id_pacienti = '".$_SESSION["user_id"]."' ";

	     $tedhena = mysqli_query($db_connect, $query);

	     if ($tedhena) {
	     	while ($row = mysqli_fetch_array($tedhena)) { 
	 	    	echo '
	 	    		
	 		            <tr>
	 			            <td>' .$row['id_doktori']. '</td>
	 			            <td>' .$row['dataora']. '</td> 
	 			            <td>'.$row['email_pacienti'].'</td>
	 			            <td>
			                <button type="button" id="'.$row['id_reservim'].'" title="Modifiko" class="btn btn-warning btn-xs btn_modifiko_rezervim"  data-toggle="modal" data-target="#modal_updaterezervim">
								<i class="fa fa-pencil-square" aria-hidden="true"> </i> 
							</button>
							<button type="button" id="'.$row['id_reservim'].'" title="Fshij" class="btn btn-danger btn-xs btn_fshij_rezervim" data-toggle="modal" data-target="#modal_fshirezervim">
								<i class="fa fa-ban" aria-hidden="true"> </i> 
							</button>
			            </td>
	 		        	</tr>
	 		        
	 	    	';
 	    }
	     } else {
	     	echo '
	     		<div class="alert alert-danger">
	 				<center><strong>Nuk u gjet asnje informacion!!</strong></center>
	 			</div>
	     	';	    
     	}
	 }

	 function gjenero_tbl_admin(){
    		require("admin_db/lidhje_db.php");

	    $query = " SELECT * FROM rezervim";

	    $tedhena = mysqli_query($db_connect, $query);

	    if ($tedhena) {
	    	while ($row = mysqli_fetch_array($tedhena)) { 
		    	echo '
		            <tr>
			            <td>'.$row['id_doktori'].'</td>
			            <td>'.$row['dataora'].'</td>
			            <td>'.$row['email_pacienti'].'</td>
			            <td>
			                <button type="button" id="'.$row['id_reservim'].'" title="Modifiko" class="btn btn-warning btn-xs btn_modifiko_rezervim" data-toggle="modal" data-target="#modal_updaterezervim">
								<i class="fa fa-pencil-square" aria-hidden="true"> </i> 
							</button>
							<button type="button" id="'.$row['id_reservim'].'" title="Fshij" class="btn btn-danger btn-xs btn_fshij_rezervim" data-toggle="modal" data-target="#modal_fshirezervim">
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

<!--/. ktu fillon permbajtja e faqes kryesore me titullin e faqes  -->
<div id="page-wrapper" >
	<div class="header"> 
		<h3 class="page-header">
			Kerkoni rezervimet tuaja :
			<span style="float: right;"><button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal_rezervim">Rezervim i ri</button></span>
		</h3>
		
		
	</div>
	<hr style="height: 1px; background-color: #ccc; border: none;" >
	
	<!--/. main content per cdo faqe fillon ketu  -->
	<div id="page-inner">
		<div class="row">
			<div class="col-md-12">
				<!--/. header i tabeles per listen e rezervimeve -->
				<div class="panel-heading">
                    Lista e te gjithe rezervimeve
                </div>
                <!--/. header i tabeles per listen e rezervimeve -->

                <!--/. tabela me listen e rezervimeve -->
                <div class="panel-body">
                    <div class="table-responsive">
                         <table class="table">
				            <thead class="thead-dark">
				                <tr>

				                    <th>Kodi i doktorit</th>
				                    <th>Data dhe ora e rezervuar</th>
				                    <th>Email i pacineti</th>
				                    <th style="width:10%;">Veprime</th>
				                </tr>
				            </thead> 
				           <?php if($_SESSION["roli"] =='admin')
				            {  gjenero_tbl_admin();
				            	 
				            }else{ gjenero_rezervime_temeparshme();}
				             ?>
                            
                        </table>
				            
                    </div>
                </div>
                <!--/. tabela me listen e rezervimeve -->
			</div>
    	</div>


<?php 
include("footer.php");
?>


<div class="modal fade" id="modal_rezervim" tabindex="-1" role="dialog" aria-labelledby="modal_rezervimLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
        	<form action="ruaj_rezervim.php" method="post">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	                <h4 class="modal-title" id="modal_rezervimLabel">Rezervim i ri</h4>
	            </div>
	            <div class="modal-body">

	            		<div class="form-group">
							<input type="text" class="form-control" id="emri_p" name="emri_p" placeholder="Emri juaj" required="required" autocomplete="off" autofocus />
						</div>

						<div class="form-group">
							<input type="text" class="form-control" id="mbiemri_p" name="mbiemri_p" placeholder="Mbiemri jua" required="required" autocomplete="off" autofocus />
						</div>
	                
						<div class="form-group">
							<input type="text" class="form-control" id="adresa_email" name="adresa_email" placeholder="adresa email" required="required" autocomplete="off" autofocus />
						</div>

						<div class="form-group">
							<input type="text" class="form-control" id="dataora" name="dataora" placeholder="Zgjidhni daten" required="required" autocomplete="off" />
						</div>

						<div>
							<div class="sub-title">Zgjidh Doktorin</div>
							<select name="doktoret" id="doktoret" class="custom-select">
								<?php doktoret(); ?>
							</select>
							
						</div>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Anullo</button>
	                <button name="btn_ruaj_rezervim" id="btn_ruaj_rezervim" class="btn btn-primary">Ruaj rezervim</button>
	            </div>
	        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_updaterezervim" tabindex="-1" role="dialog" aria-labelledby="modal_rezervimLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
        	<form action="ruaj_rezervim.php" method="post">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	                <h4 class="modal-title" id="modal_rezervimLabel">Modifiko Rezervim</h4>
	            </div>
        		
	            <div class="modal-body">
	            		<div class="form-group">
							<input type="text" class="form-control" id="emri_p" name="emri_p" placeholder="Emri juaj" required="required" autocomplete="off" autofocus />
						</div>

						<div class="form-group">
							<input type="text" class="form-control" id="mbiemri_p" name="mbiemri_p" placeholder="Mbiemri juaj" required="required" autocomplete="off" autofocus />
						</div>
	                
						<div class="form-group">
							<input type="text" class="form-control" id="adresa_email" name="adresa_email" placeholder="adresa email" required="required" autocomplete="off" autofocus />
						</div>

						<div class="form-group">
							<input type="text" class="form-control" id="mod_dataora" name="mod_dataora" placeholder="Zgjidhni daten" required="required" autocomplete="off"/>
						</div>

						<input type="hidden" class="form-control" id="idRezervim" name="id_mod"/>

						<div>
							<div class="sub-title">Zgjidh Doktorin</div>
							<select name="doktoret" id="doktoret" class="custom-select">
								<?php doktoret(); ?>
							</select>
							
						</div>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Anullo</button>
	                <button name="btn_ruaj_updaterezervim" id="btn_ruaj_updaterezervim" class="btn btn-primary" type="submit">Ruaj ndryshimet</button>
	            </div>
	        </form>
        </div>
    </div>
</div>



	<div class="modal fade" id="modal_fshirezervim" tabindex="-1" role="dialog" aria-labelledby="modal_rezervimLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
        	<form action="ruaj_rezervim.php" id = "deleteForm" method="post">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	                <h4 class="modal-title" id="modal_rezervimLabel">Fshi Rezervim</h4>
	            </div>
        		
	            <div class="modal-body">
	            	<p class="alert alert-error">Are you sure to delete ?</p>	
	            	<input type="hidden" class="form-control" id="idDelete" name="id_del" />
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Anullo</button>
	                <button name="btn_ruaj_fshirezervim" id="btn_ruaj_fshirezervim" class="btn btn-primary" type="submit">Fshi</button>

	            </div>
	        </form>
        </div>
    </div>
</div>
	
	

<script type="text/javascript">

	$(document).ready(function() {
		$('#dataora').datetimepicker();
	});
	$(document).ready(function() {
		$('#mod_dataora').datetimepicker();
	});
	

</script>

<script type="text/javascript">
	$(document).ready(function() {
		
		$(document).on("click", ".btn_modifiko_rezervim", function() {
			var id_mod = $(this).attr("id");

			document.getElementById("idRezervim").value = id_mod;

		});


		$(document).on("click", ".btn_fshij_rezervim", function() {
			var id_del = $(this).attr("id");

			document.getElementById("idDelete").value = id_del;
				}	
			);
	});	
</script>