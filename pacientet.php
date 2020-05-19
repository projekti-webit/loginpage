<?php 

	include("header.php");
    include("top_menu.php");
    include("menu.php");

function gjenero_tbl_pacienteve() {
    	require("admin_db/lidhje_db.php");

	    $query = " SELECT * FROM perdoruesit where roli = 'pacient' ";

	    $tedhena = mysqli_query($db_connect, $query);

	    if ($tedhena) {
	    	while ($row = mysqli_fetch_array($tedhena)) { 
		    	echo '
		            <tr>
			            <td>'.$row['emri'].'</td>
			            <td>'.$row['mbiemri'].'</td>
			            <td>'.$row['email'].'</td>
			            
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
			Jeni ne faqen e listes se pacienteve
		</h3>
	</div>
	<hr style="height: 1px; background-color: #ccc; border: none;" >
	
	<!--/. main content per cdo faqe fillon ketu  -->
	<div id="page-inner">
		<div class="row">
			<div class="col-md-12">
				<!--/. header i tabeles per listen e pacienteve -->
				<div class="panel-heading">
                    Lista e pacienteve te rregjistruar te Klinikes BioLife
                </div>
                <!--/. header i tabeles per listen e pacienteve -->

                <!--/. tabela me listen e pacienteve -->
                <div class="panel-body">
                    <div class="table-responsive">
                        
                       <table class="table">
				            <thead class="thead-dark">
				                <tr>
				                    <th>Emri</th>
				                    <th>Mbiemri</th>
				                    <th>Email</th>
				                    
				                    
				                </tr>
				            </thead> 
				            <?php gjenero_tbl_pacienteve(); ?>
                            
                        </table>
                    </div>
                </div>
                <!--/. tabela me listen e pacienteve -->
			</div>
    	</div>

<?php 
include("footer.php");
?>