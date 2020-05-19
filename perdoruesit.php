<?php 

    include("header.php");
    include("top_menu.php");
    include("menu.php");

    function kerkimi(){
        require("admin_db/lidhje_db.php");
        if(isset($_POST["submit"])){

        $kerkohet = $_POST["kerkimi"];
        
        $query_kerkim = "SELECT * FROM perdoruesit WHERE emri LIKE '%{$kerkohet}%' OR mbiemri LIKE '%{$kerkohet}%'
        ";
         $pergjigje_kerkim = mysqli_query($db_connect, $query_kerkim);

        while ($row = mysqli_fetch_array($pergjigje_kerkim))
{
        echo $row["emri"]. " " . $row['mbiemri'];
        echo "<br>";
}

    }
}



    function gjenero_tbl_staf() {
        require("admin_db/lidhje_db.php");

        $query = " SELECT * FROM perdoruesit where roli = 'staf' ";

        $tedhena = mysqli_query($db_connect, $query);

        if ($tedhena) {
            while ($row = mysqli_fetch_array($tedhena)) { 
                echo '
                    <tr>
                        <td>'.$row['emri'].'</td>
                        <td>'.$row['mbiemri'].'</td>
                        <td>'.$row['email'].'</td>
                     <td>
                            <button type="button" id="'.$row['user_id'].'" title="Modifiko" class="btn btn-warning btn-xs btn_modifiko_user" data-toggle="modal" data-target="#modal_update">
                                <i class="fa fa-pencil-square" aria-hidden="true"> </i> 
                            </button>
                            <button type="button" id="'.$row['user_id'].'" title="Fshij" class="btn btn-danger btn-xs btn_fshij_user" data-toggle="modal" data-target="#modal_fshiuser">
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
    function gjenero_tbl_pacient(){
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
                        <td>
                            <button type="button" id="'.$row['user_id'].'" title="Modifiko" class="btn btn-warning btn-xs btn_modifiko_user" data-toggle="modal" data-target="#modal_update">
                                <i class="fa fa-pencil-square" aria-hidden="true"> </i> 
                            </button>
                            <button type="button" id="'.$row['user_id'].'" title="Fshij" class="btn btn-danger btn-xs btn_fshij_user" data-toggle="modal" data-target="#modal_fshiuser">
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

    function gjenero_tbl_newuser(){
        require("admin_db/lidhje_db.php");

        $query = " SELECT * FROM perdoruesit where roli = 'new' ";

        $tedhena = mysqli_query($db_connect, $query);

        if ($tedhena) {
            while ($row = mysqli_fetch_array($tedhena)) { 
                echo '
                    <tr>
                        <td>'.$row['emri'].'</td>
                        <td>'.$row['mbiemri'].'</td>
                        <td>'.$row['email'].'</td>
                        <td>
                            <button type="button" id="'.$row['user_id'].'" title="Modifiko" class="btn btn-warning btn-xs btn_modifiko_user" data-toggle="modal" data-target="#modal_update">
                                <i class="fa fa-pencil-square" aria-hidden="true"> </i> 
                            </button>
                            <button type="button" id="'.$row['user_id'].'" title="Fshij" class="btn btn-danger btn-xs btn_fshij_user" data-toggle="modal" data-target="#modal_fshiuser">
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
			Administrimi per te gjithe perdoruesit
            <form method = "post" action = "perdoruesit.php">
           
            <span style="float: right;"><label><input type= "text" name="kerkimi" id="kerkimi" autocomplete="off"></label>
            <input type= "submit" name="submit" id = "submit" value ="Kerko" class="btn btn-primary" ></span>
             <?php kerkimi();?>
         </form>
		</h3>
	</div>
    <hr style="height: 1px; background-color: #ccc; border: none;" >
	
	<!--/. main content per cdo faqe fillon ketu  -->
	<div id="page-inner">
		
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Stafi mjekesor
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="tbl_stafi">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Emri</th>
                                    <th>Mbiemri</th>
                                    <th>Email</th>
                                    
                                    
                                </tr>
                            </thead> 
                            <?php gjenero_tbl_staf(); ?>
                            
                        
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                         Pacientet
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="tbl_stafi">
                                
                                 <thead class="thead-dark">
                                <tr>
                                    <th>Emri</th>
                                    <th>Mbiemri</th>
                                    <th>Email</th>
                                    
                                    
                                </tr>
                            </thead> 
                            <?php gjenero_tbl_pacient(); ?>
                            
                            </table>
                        </div>
                    </div>
                </div>
            </div>
             <div class="col-md-6 col-sm-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        Perdorues te rinj
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="tbl_stafi">
                               
                                 <thead class="thead-dark">
                                <tr>
                                    <th>Emri</th>
                                    <th>Mbiemri</th>
                                    <th>Email</th>
                                    
                                    
                                </tr>
                            </thead> 
                            <?php gjenero_tbl_newuser(); ?>
                            
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    	</div>


        <div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="modal_Label" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="ruaj_perdorues.php" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="modal_Label">Modifiko Perdorues</h4>
                </div>
                
                <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="emri" name="emri" placeholder="Emri" required="required" autocomplete="off" autofocus />
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="mbiemri" name="mbiemri" placeholder="Mbiemri" required="required" autocomplete="off" autofocus />
                        </div>
                    
                        <div class="form-group">
                            <input type="text" class="form-control" id="email" name="email" placeholder="adresa email" required="required" autocomplete="off" autofocus />
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="roli" name="roli" placeholder="pacient/staf/new" required="required" autocomplete="off" autofocus />
                        </div>

                        <input type="hidden" class="form-control" id="iduser" name="id_mod"/>

                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Anullo</button>
                    <button name="btn_ruaj_updateuser" id="btn_ruaj_updateuser" class="btn btn-primary" type="submit">Ruaj ndryshimet</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_fshiuser" tabindex="-1" role="dialog" aria-labelledby="modal_Label" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="ruaj_perdorues.php" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="modal_rezervimLabel">Fshi Perdorues</h4>
                </div>
                
                <div class="modal-body">
                    <p class="alert alert-error">Jeni te sigurte per fshirjen e rekordit ?</p>   
                    <input type="hidden" class="form-control" id="idDelete" name="id_del" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Anullo</button>
                    <button name="btn_ruaj_fshiuser" id="btn_ruaj_fshiuser" class="btn btn-primary" type="submit">Fshi</button>

                </div>
            </form>
        </div>
    </div>
</div>

<?php 
include("footer.php");
?>

<script type="text/javascript">
    $(document).ready(function() {
        
        $(document).on("click", ".btn_modifiko_user", function() {
            var id_mod = $(this).attr("id");

            document.getElementById("iduser").value = id_mod;

        });


        $(document).on("click", ".btn_fshij_user", function() {
            var id_del = $(this).attr("id");

            document.getElementById("idDelete").value = id_del;
                }   
            );
    }); 
</script>
