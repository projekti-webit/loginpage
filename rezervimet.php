<?php 
	
	//session_start();

	include("header.php");
    include("top_menu.php");
    include("menu.php");

    function gjenero_tbl_kryesore() {
    	require("admin_db/lidhje_db.php");

	    $query = " SELECT * FROM rezervim where id_doktori = '".$_SESSION["user_id"]."' ";

	    $tedhena = mysqli_query($db_connect, $query);

	    if ($tedhena) {
	    	while ($row = mysqli_fetch_array($tedhena)) { 
		    	echo '
		            <tr>
			            <td>'.$row['emri_p'].'</td>
			            <td>'.$row['mbiemri_p'].'</td>
			            <td>'.$row['dataora'].'</td>
			            <td>'.$row['email_pacienti'].'</td>
			            <td>
			                <button type="button" id="'.$row['id_reservim'].'" title="Modifiko" class="btn btn-warning btn-xs btn_modifiko_rezervim">
								<i class="fa fa-pencil-square" aria-hidden="true"> </i> 
							</button>
							<button type="button" id="'.$row['id_reservim'].'" title="Fshij" class="btn btn-danger btn-xs btn_fshij_rezervim">
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
			Jeni ne faqen e rezervimeve
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
				                    <th>Emri</th>
				                    <th>Mbiemri</th>
				                    <th>Data dhe ora</th>
				                    <th>Adresa e-mail</th>
				                    <th style="width:10%;">Veprime</th>
				                </tr>
				            </thead> 
				            <?php gjenero_tbl_kryesore(); ?>
                    </div>
                </div>
                <!--/. tabela me listen e rezervimeve -->
			</div>
    	</div>


<?php 
include("footer.php");
?>

<script type="text/javascript">
	$(document).ready(function() {
		
		$(document).on("click", ".btn_modifiko_rezervim", function() {
			debugger;
			var id_mod = $(this).attr("id");
			var detyra_edit = "modifiko_rezervim";
			//alert(id);
			$.ajax({
				url:"ruaj_rezervim.php",
				method:"POST",
				data:{id_mod:id_mod, detyra_edit:detyra_edit},
				//dataType:"json",
				success: function(rezultati) {
					alert(rezultati);
				}
			});
		});

		$(document).on("click", ".btn_fshij_rezervim", function() {
			var id_del = $(this).attr("id");
			var detyra_del = "fshij_rezervim";
			//alert(id);
			$.ajax({
				url:"ruaj_rezervim.php",
				method:"POST",
				data:{id_del:id_del, detyra_del:detyra_del},
				//dataType:"json",
				success: function(rezultati) {
					alert(rezultati);
				}
			});
		});

	});


</script>