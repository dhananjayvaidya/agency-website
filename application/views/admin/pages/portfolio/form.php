<div class="container-fluid">
<!-- Page Heading -->
    <div class='floating-btns right'>
        <a href='<?php echo base_url('admin/team');?>' class='pull-right'>View Team</a>
    </div>
    <h1 class="h3 mb-2 text-gray-800"><?php echo $action;?> Portfolio</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <?php 
                if ($message){
                    echo "<div class='alert alert-info'>".$message."</div>";
                }
            ?>
            <form action="" method="post" enctype="multipart/form-data" >
                <input type='hidden' value="<?php echo $team_data[0]['id'];?>" name='id' />
                <input type='hidden' name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                <div class='form-group'>
                    <label>Media (Images/Videos)</label>
                    <input type='file' name='media[]' multiple id='media' class='form-control' />
                    <?php 
                        if ($team_data[0]['profile_photo']){
                            echo "<img src='".base_url($team_data[0]['profile_photo'])."' />";
                        }
                    ?>
                </div>
                <div class="form-group">
                    <label>Portfolio Category</label>
                    <select name='cat_id' id='cat_id' class="form-control">
                        <option value="">Select category</option>
                        <?php 
                            foreach($categories as $category){
                                echo "<option value='".$category['id']."'>".$category['cat_name']."</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class='form-group'>
                    <label>Project name</label>
                    <input type='text' name='project_name' id='project_name' value="<?php echo $team_data[0]['full_name'];?>" placeholder="Enter Project Name" class='form-control'/>
                </div>
                <div class='form-group'>
                    <label>Project Description</label>
                    <textarea class='form-control' name='project_desc' id='project_desc' placeholder="Enter Project Description" ><?php echo $data[0]['project_desc'];?></textarea>
                </div>
                <div class='form-group'>
                    <label>Client Name</label>
                    <input type='text' name='client_name' value="<?php echo $data[0]['client_name'];?>" id='client_name' placeholder="Enter Client Name" class='form-control'/>
                </div>
                <div class='form-group'>
                    <label>Project Link</label>
                    <input type='text' name='project_link' value="<?php echo $data[0]['project_link'];?>" id='project_link' placeholder="Enter Project Link" class='form-control'/>
                </div>
                <div class='form-group'>
                    <label>Project Date</label>
                    <input type='date' name='project_date' value="<?php echo $data[0]['project_date'];?>" id='project_date' class='form-control'/>
                </div>
                <label>Status</label>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><input type="radio" name="status" value="1"/> Active</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><input type="radio" name="status" value="0"/> In active</label>
                        </div>
                    </div>
                </div>
                <input type='submit' name='submit' class='btn btn-primary' value=' Submit ' />
            </form>  
        </div>
    </div>
</div>