<div class="container-fluid">
<!-- Page Heading -->
    <div class='floating-btns right'>
        <a href='<?php echo base_url('admin/portfolio_categories');?>' class='pull-right'>View Portfolio Categories</a>
    </div>
    <h1 class="h3 mb-2 text-gray-800"><?php echo $action;?> Portfolio Category</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <?php 
                if ($message){
                    echo "<div class='alert alert-info'>".$message."</div>";
                }
            ?>
            <form action="" method="post" enctype="multipart/form-data" >
                <input type='hidden' value="<?php echo $portfolio_category_data[0]['id'];?>" name='id' />
                <input type='hidden' name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                
                <div class='form-group'>
                    <label>Category Name</label>
                    <input type='text' name='cat_name' id='cat_name' value="<?php echo $portfolio_category_data[0]['cat_name'];?>" placeholder="Enter Category Name" class='form-control'/>
                </div>
                <div class='form-group'>
                    <label>Sort Order</label>
                    <input type='text' name='sort_order' value="<?php echo $portfolio_category_data[0]['sort_order'];?>" id='sort_order' placeholder="Enter Sort Order" class='form-control'/>
                </div>
                <div class='row'>
                    <div class='col-md-4'>
                        <div class='form-group'>
                            <label><input type='radio' name='status' value="1" <?php echo ($portfolio_category_data[0]['status'] == 1? 'CHECKED':'');?> id='status_enable' /> Enable</label>
                        </div>
                    </div>
                    <div class='col-md-4'>
                        <div class='form-group'>
                            <label><input type='radio' name='status' value="0" <?php echo ($portfolio_category_data[0]['status'] == 0? 'CHECKED':'');?> id='status_disable' /> Disable</label>
                        </div>
                    </div>
                    
                </div>
                
                <input type='submit' name='submit' class='btn btn-primary' value=' Submit ' />
            </form>  
        </div>
    </div>
</div>