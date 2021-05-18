<div class="container-fluid">
    <!-- Page Heading -->
            <div class='floating-btns right'>
                <a href='<?php echo base_url('admin/team/add');?>' class='pull-right'>Add Team</a>
            </div>
            
            <h1 class="h3 mb-2 text-gray-800">Teams</h1>
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Photo</th>    
                                            <th>Full Name</th>
                                            <th>Designation</th>
                                            <th>About Me</th>
                                            <th>Social Links</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <?php 
                                        foreach($teams as $team){
                                            ?>
                                            <tr>
                                                <td><img src='<?php echo base_url($team['profile_photo']);?>' /></td>
                                                <td><?php echo $team['full_name'];?></td>
                                                <td><?php echo $team['designation'];?></td>
                                                <td><?php echo substr($team['about_me'],0,255);?></td>
                                                <td>
                                                    <?php 
                                                        if ($team['fb_link'] != ""){
                                                            echo "<a href='".$team['fb_link']."'><i class='fab fa-facebook'></i></a>";
                                                        }
                                                        if ($team['ln_link'] != ""){
                                                            echo "<a href='".$team['ln_link']."'><i class='fab fa-linkedin'></i></a>";
                                                        }
                                                        if ($team['tw_link'] != ""){
                                                            echo "<a href='".$team['tw_link']."'><i class='fab fa-twitter'></i></a>";
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo date('d-m-Y',$team['mod_timestamp']);?>
                                                </td>
                                                <td>
                                                    <a href='<?php echo base_url('admin/team/edit/'.$team['id']);?>'><i class='fas fa-pencil-alt'></i></a> 
                                                    <a href='<?php echo base_url('admin/team/delete/'.$team['id']);?>'><i class='fas fa-trash'></i></a>
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