<div class="container-fluid">
    <!-- Page Heading -->
            <div class='floating-btns right'>
                <a href='<?php echo base_url('admin/portfolio_categories/add');?>' class='pull-right'>Add Portfolio Category</a>
            </div>
            
            <h1 class="h3 mb-2 text-gray-800">Portfolio Categories</h1>
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                              
                                            <th>Category Name</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <?php 
                                        foreach($portfolio_categories as $portfolio_category){
                                            ?>
                                            <tr>
                                                <td><?php echo $portfolio_category['cat_name'];?></td>
                                                
                                                <td><?php echo ($portfolio_category['status'] == 1 ? 'Enabled':'Disabled');?></td>
                                                
                                                <td>
                                                    <?php echo date('d-m-Y',$portfolio_category['mod_timestamp']);?>
                                                </td>
                                                <td>
                                                    <a href='<?php echo base_url('admin/portfolio_categories/edit/'.$portfolio_category['id']);?>'><i class='fas fa-pencil-alt'></i></a> 
                                                    <a href='<?php echo base_url('admin/portfolio_categories/delete/'.$portfolio_category['id']);?>'><i class='fas fa-trash'></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    ?>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
</div>