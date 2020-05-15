<?php 

    include("header.php");
    include("top_menu.php");
    include("menu.php");

?>

<!--/. ktu fillon permbajtja e faqes kryesore me titullin e faqes  -->
<div id="page-wrapper" >
	<div class="header"> 
		<h3 class="page-header">
			Jeni ne faqen e administrimit per te gjithe perdoruesit
		</h3>
	</div>
    <hr style="height: 1px; background-color: #ccc; border: none;" >
	
	<!--/. main content per cdo faqe fillon ketu  -->
	<div id="page-inner">
		
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Te gjithe pacientet
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="tbl_stafi">
                                lista me tbl e te gjithe pacienteve
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        I gjith stafi mjeksor
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="tbl_stafi">
                                lista me tbl e te gjithe stafit
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    	</div>

<?php 
include("footer.php");
?>