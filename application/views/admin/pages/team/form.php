<div class="container-fluid">
<!-- Page Heading -->
    <div class='floating-btns right'>
        <a href='<?php echo base_url('admin/team');?>' class='pull-right'>View Team</a>
    </div>
    <h1 class="h3 mb-2 text-gray-800"><?php echo $action;?> Team</h1>
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
                    <label>Profile Photo</label>
                    <input type='file' name='profile_photo' id='profile_photo' class='form-control' />
                    <?php 
                        if ($team_data[0]['profile_photo']){
                            echo "<img src='".base_url($team_data[0]['profile_photo'])."' />";
                        }
                    ?>
                </div>
                <div class='form-group'>
                    <label>Full Name</label>
                    <input type='text' name='full_name' id='full_name' value="<?php echo $team_data[0]['full_name'];?>" placeholder="Enter Full Name" class='form-control'/>
                </div>
                <div class='form-group'>
                    <label>Designation</label>
                    <input type='text' name='designation' value="<?php echo $team_data[0]['designation'];?>" id='designation' placeholder="Enter Designation" class='form-control'/>
                </div>
                <div class='row'>
                    <div class='col-md-4'>
                        <div class='form-group'>
                            <label>Facebook</label>
                            <input type='text' name='fb_link' value="<?php echo $team_data[0]['fb_link'];?>" id='fb_link' placeholder="Enter Facebook Profile Link" class='form-control'/>
                        </div>
                    </div>
                    <div class='col-md-4'>
                        <div class='form-group'>
                            <label>LinkedIn</label>
                            <input type='text' name='ln_link' value="<?php echo $team_data[0]['ln_link'];?>" id='ln_link' placeholder="Enter LinkedIn Profile Link" class='form-control'/>
                        </div>
                    </div>
                    <div class='col-md-4'>
                        <div class='form-group'>
                            <label>Twitter</label>
                            <input type='text' name='tw_link' value="<?php echo $team_data[0]['tw_link'];?>" id='tw_link' placeholder="Enter Twitter Profile Link" class='form-control'/>
                        </div>
                    </div>
                </div>
                <div class='form-group'>
                    <label>About</label>
                    <textarea class='form-control' name='about_me' id='about_me' placeholder="Enter About me" ><?php echo $team_data[0]['about_me'];?></textarea>
                </div>
                <input type='submit' name='submit' class='btn btn-primary' value=' Submit ' />
            </form>  
        </div>
    </div>
</div>