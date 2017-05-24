<?php include 'includes/admin_header.php' ?>


    <div id="wrapper">
        
        
        
        
        

        <!-- Navigation -->
        <?php include 'includes/admin_navigation.php' ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                       
                        <h1 class="page-header">
                            Welcome to admin
                            <small>Author</small>
                        </h1>
                        
                        <div class="col-xs-6">
                        
                        <?php insert_categories(); ?>
                        
                        	<form action="" method="post">
                        		<div class="form-group">
                        		<label for="cat_title">Category Title</label>
                        			<input type="text" name="cat_title" class="form-control">
                        		</div>
                        		<div class="form-group">
                        			<input type="submit" name="submit" value="Add Category" class="btn btn-primary">
                        		</div>
                        	</form>
                        	
                        	
                  <?php
					
					if(isset($_GET['edit'])){
						$cat_id = $_GET['edit'];
						
						include "includes/edit_category.php";
					}
							
					?>
                        			
                        		
                        	
                        </div>
                        <div class="col-xs-6">
                        
                        
                        	<table class="table table-bordered table-hover">
                        		<thead>
                        			<tr>
                        				<th class="text-center">Id</th>
                        				<th class="text-center">Category Title</th>
                        				<th class="text-center">Delete</th>
                        				<th class="text-center">Edit</th>
                        			</tr>
                        		</thead>
                        		<tbody>
                        			
                        				<?php 
											find_all_categories();
										?>
                       			
                       					<?php
											delete_categories();
									
										?>
                        			
                        		</tbody>
                        	</table>
                        	
                        	
                        </div>
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

   <?php include 'includes/admin_footer.php'; ?>